<?php

namespace App\Http\Controllers\Api\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\RegisterRequest;
use App\Repository\Auth\IAuthRepository;

class RegisterController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(RegisterRequest $request, IAuthRepository $IAuthRepository)
    {
        $validated = $request->validated();
        $data = $request->all();

        $result = $IAuthRepository->register($data);

        return response()->json([
            'statusCode' => $result['code'],
            'message' => $result['message'],
            'data' => $result['data'],
        ], $result['code']);
    }
}
