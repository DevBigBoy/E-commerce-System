<?php

namespace App\Http\Controllers\Api\Auth;

use App\Enums\UserStatus;
use App\Http\Controllers\Controller;
use App\Http\Requests\Api\Auth\RegisterUserRequest;
use App\Http\Resources\UserResource;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class RegisteredUserController extends Controller
{
    public function register(RegisterUserRequest $request)
    {
        try {
            $userData =  $request->validated();

            if (isset($userData['image'])){
                $userData['image'] = 'Not Set Yet';
            }

            $userData['password'] = Hash::make($userData['password']);
            $userData['status'] = UserStatus::ACTIVE;

            $user =  User::create($userData);

            $token = $user->createToken('auth_token', ['app:all'])->plainTextToken;

            $data = [
                'user' => new UserResource($user),
                'token' => $token,
            ];

            return response()->json([
                'message' => 'User registered successfully',
                'data' => $data,
            ], 201);

        } catch (\Exception $exception){
            return response()->json([
                'message' => 'Registration failed',
                'error' => $exception->getMessage(),
            ], 500);
        }
    }
}
