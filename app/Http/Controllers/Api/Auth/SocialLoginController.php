<?php

namespace App\Http\Controllers\Api\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Laravel\Socialite\Facades\Socialite;

class SocialLoginController extends Controller
{
    public function socialLogin($provider)
    {
        try {
            $socialUser = Socialite::driver($provider)->user();

            $user = User::firstOrCreate(
                [
                    'provider' => $provider,
                    'provider_id' => $socialUser->getId()
                ],
                [
                    'name' => $socialUser->getName(),
                    'email' => $socialUser->getEmail(),
                    'provider' => $provider,
                    'provider_token' => $socialUser->token,
                    'password' => Hash::make(Str::random(16)),
                    'email_verified_at' => now(),
                ]
            );

            // Create API token for the user (you can customize token generation)
            $token = $user->createToken('MobileApp')->accessToken;

            return response()->json([
                'status' => true,
                'message' => 'Login successful via ' . ucfirst($provider),
                'token' => $token->plainTextToken,
                'user' => $user,
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => false,
                'message' => 'Failed to login via ' . ucfirst($provider),
                'error' => $e->getMessage(),
            ], 400);
        }
    }
}
