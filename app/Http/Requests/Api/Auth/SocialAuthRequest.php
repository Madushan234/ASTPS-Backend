<?php

namespace App\Http\Requests\Api\Auth;

use App\Models\User;
use App\Constants\AuthType;
use Illuminate\Validation\Rule;
use App\Http\Requests\Auth\LoginRequest;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;

class SocialAuthRequest extends LoginRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'type' => ['required', 'string', 'max:255', Rule::in([AuthType::GOOGLE])],
            'email' => ['required', 'email'], 'max:255',
            'firstName' => ['required', 'string', 'max:255'],
            'lastName' => ['nullable', 'string', 'max:255'],
            'telephone' => ['nullable', 'string', 'max:255'],
            'token' => ['required', 'string'],
            'fcmToken' => ['nullable', 'string', 'max:255'],
        ];
    }

    /**
     * Attempt to authenticate the request's credentials.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function authenticate(): void
    {
        $this->ensureIsNotRateLimited();

        $user = User::where("email", $this->email)->first();
        if ($user) {
            Auth::login($user);
            RateLimiter::clear($this->throttleKey());
        } else {
            throw ValidationException::withMessages([
                'email' => 'The selected email is invalid.',
                'isUser' => false
            ]);
        }
    }
}
