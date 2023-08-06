<?php

namespace App\Repository\Auth;

use App\Models\User;
use Exception;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Request;

class AuthRepository implements AuthRepositoryInterface {
  public function login($email, $password){
    $user = User::where('email', $email)->first();

    if (!$user){
      return response()->json([
        'message' => "Email not found",
        'statusCode' => 401,
      ], 401);
    };

    if (!Hash::check($password, $user->password)){
      return response()->json([
        'message' => "Invalid Password",
        'statusCode' => 401,
      ], 401);
    };

    $token = $this->generateToken($user);

    return response()->json([
      'message' => "Login success",
      'data' => [ 'token' => $token ],
    ]);
  }

  public function register($data){
    try{
      $data['password'] = Hash::make($data['password']);
    
      $user = User::create($data);

      if(!$user){
        return [
          'error' => true,
          'message' => 'Terjadi Kesalahan',
          'code' => 500,
          "data" => null
        ];
      }

      $token =  $this->generateToken($user);
      return [
        'error' => false,
        'message' => 'Sukses Registrasi',
        'code' => 201,
        "data" => [
          'token' => $token
        ],
      ];
    }
    catch(Exception $e){
      Log::error("Error Register", ['message' => $e->getMessage()]);

      return [
        'error' => true,
        'message' => $e->getMessage(),
        'code' => 500,
        "data" => null
      ];
    }
  }

  public function logout(Request $request){
    $request->user()->token()->delete();

    return response()->noContent();
  }

  private function generateToken(User $user){
    $role = "admin";
    $scopes = ['create-news', 'update-news', 'delete-news', 'create-comment'];

    if($user->is_admin != 1){
      $role = "user";
      $scopes = ['create-comment'];
    }

    $token = $user->createToken($role, $scopes);


    return $token->accessToken;
  }
}