<?php

namespace App\Services\Auth;

use App\Http\Requests\Auth\LoginRequest;
use App\Models\FcmToken;
use App\Models\User;
use Illuminate\Support\Facades\Password;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Facades\Hash;
use App\Services\Mail\MailService;

class ApiAuthService
{
    /**
     * sens welcome email
     **/
    public function sendWelcomeEmail($email, $name): void
    {
        $mailService = new MailService([
            'to' => $email,
            'layoutName' => 'email.welcome-email',
            'subject' => 'Welcome email for ASTPS',
            'data' => [
                'email' => $email,
                'name' => $name
            ]
        ]);
        $mailService->send();
    }

    /**
     * create user
     **/
    public function createCustomer(array $data)
    {
        $user = User::create([
            'first_name' => $data['first_name'],
            'last_name' => $data['last_name'],
            'email' => $data['email'],
            'telephone' => $data['telephone'],
            'password' => Hash::make($data['password'])
        ]);
        $user->addRole('customer');
        $this->sendWelcomeEmail($data['email'], $data['first_name']);
        return [
            'message' => 'Account created successfully.',
            'user' => $user
        ];
    }

    /**
     * api login
     **/
    public function login(LoginRequest $request, $role)
    {
        $request->authenticate();
        if ($request->user()->hasRole($role)) {
            $token = $request->user()->createToken('auth_token');
            if ($request->token) {
                FcmToken::updateOrCreate(
                    ['user_id' => $request->user()->id],
                    ['token' => $request->token]
                );
            }
            return [
                'token' => $token->plainTextToken,
                'user' => $request->user()
            ];
        }
        throw ValidationException::withMessages([
            'email' => trans('auth.unauthorized'),
        ]);
    }

    /**
     * send password reset link
     **/
    public function sendResetPasswordLink($requestData)
    {
        $status = Password::sendResetLink(
            $requestData
        );

        if ($status == Password::RESET_LINK_SENT) {
            return ['message' => __($status)];
        }

        throw ValidationException::withMessages([
            'email' => [trans($status)],
        ]);
    }
}
