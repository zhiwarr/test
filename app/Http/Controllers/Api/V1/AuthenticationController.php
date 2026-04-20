<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\BaseController;
use Illuminate\Http\Request;

class AuthenticationController extends BaseController
{
    public function login(Request $request)
    {
        $request->validate([
            'email' => ['required', 'email', 'lowercase'],
            'password' => ['required', 'string', 'min:6'],
        ]);

        $credentials = $request->only('email', 'password');

        //if user not have credintials throws a 401 error if it is creates a token for him
        if (!auth()->attempt($credentials)) {
            return $this->sendError(__('Invalid credentials'), 401);
        }

        $user = auth()->user();
        $token = $user->createToken($user->email)->plainTextToken;

        return $this->sendResponse([
            'message' => __('Login successful'),
            'token' => $token,
            'user' => $user,
        ]);
    }

    public function logout(Request $request)
    {
        //remove current authenticated user token
        $request->user()->currentAccessToken()->delete();

        return $this->sendSuccess(__('Logout Successful'));
    }
}