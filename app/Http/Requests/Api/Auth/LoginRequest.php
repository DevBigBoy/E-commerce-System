<?php

namespace App\Http\Requests\Api\Auth;

use App\Models\User;
use Illuminate\Foundation\Http\FormRequest;

class LoginRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'email' => [
                'required',
                'string',
                function ($attribute, $value, $fail) {
                    // If it's a valid email address:
                    if (filter_var($value, FILTER_VALIDATE_EMAIL)) {
                        if (!User::where('email', $value)->exists()) {
                            $fail('No user found with this email address.');
                        }
                    }
                    // Else if it's a valid 11-digit phone number:
                    elseif (preg_match('/^\d{11}$/', $value)) {
                        if (!User::where('phone_number', $value)->exists()) {
                            $fail('No user found with this phone number.');
                        }
                    }
                    // If it's neither a valid email nor an 11-digit phone number:
                    else {
                        $fail('The login field must be a valid email address or an 11-digit phone number.');
                    }
                }
            ],
            'password' => ['required', 'string', 'min:8'],
        ];
    }
}
