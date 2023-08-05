<?php

namespace App\Repository\Auth;

use Illuminate\Support\Facades\Request;

interface IAuthRepository {
  public function login($email, $password);
  public function register($data);
  public function logout(Request $request);
}