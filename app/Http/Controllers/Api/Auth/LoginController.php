<?php

namespace App\Http\Controllers\Api\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\Auth\LoginRequest;
use App\Http\Resources\UserResource;
use App\Models\User;
use Illuminate\Http\Request;

class LoginController extends Controller
{
    public function login(LoginRequest $loginRequest)
    {

        try {
            $data = $loginRequest->validated();


            $loginInput = $data['email'];
            $loginField = filter_var($loginInput, FILTER_VALIDATE_EMAIL) ? 'email' : 'phone_number';

            $credentials = [
                $loginField => $loginInput,
                'password'  => $data['password'],
            ];

            if (auth()->attempt($credentials)) {
                $user = auth()->user();
                // Remove old tokens
                $user->tokens()->delete();
                // Create a new token; here we use userAgent() for token naming
                $token = $user->createToken($loginRequest->userAgent())->plainTextToken;

                return response()->json([
                    'message' => 'Login successful',
                    'user'    => new UserResource($user), // You may wrap this in a resource if needed.
                    'token'   => $token,
                ], 200);
            } else {
                return response()->json([
                    'message' => 'Invalid credentials',
                ], 401);
            }
        } catch (\Exception $exception) {
            return response()->json([
                'message' => 'Login failed',
                'error'   => $exception->getMessage(),
            ], 500);
        }


    }
}
