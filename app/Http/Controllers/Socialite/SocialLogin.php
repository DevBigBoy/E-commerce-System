<?php

namespace App\Http\Controllers\Socialite;

use App\Enums\UserStatus;
use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Laravel\Socialite\Facades\Socialite;

class SocialLogin extends Controller
{
    public function redirect($provider): RedirectResponse
    {
        return Socialite::driver($provider)->redirect();
    }

    public function callback($provider): RedirectResponse
    {
        try {
            $socialUser = Socialite::driver($provider)->user();

            if (User::where('email', $socialUser->getEmail())->where('provider', '!=', $provider)->exists()) {
                return  redirect('/login')->withErrors(['email' => 'This email uses different method to login.']);
            }


            $randomPassword = Str::random(16);

            $user = User::firstOrCreate(
                [
                    'provider' => $provider,
                    'provider_id' => $socialUser->getId(),
                ],
                [
                    'first_name' => $socialUser->getName(),
                    'last_name' => $socialUser->getName(),
                    'email' => $socialUser->getEmail(),
                    'provider_token' => $socialUser->token,
                    'password' => Hash::make($randomPassword),
                    'email_verified_at' => now(),
                    'status' => UserStatus::ACTIVE,
                ]
            );

            Auth::login($user, true);

            return to_route('dashboard');

        } catch (\Exception $e) {

            return to_route('login');
        }

    }
}
