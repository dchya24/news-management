<?php

namespace App\Http\Controllers\Api\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Repository\Auth\AuthRepositoryInterface;

class LoginController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(LoginRequest $request, AuthRepositoryInterface $iAuthRepository)
    {
        $request->safe()->only(['email', 'password']);
        $data = $request->all();

        return $iAuthRepository->login($data['email'], $data['password']);
    }
}
