<?php

namespace App\Services\Auth;

use App\Http\Requests\Auth\LoginRequest;
use App\Models\FcmToken;
use App\Models\User;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Password;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Facades\Hash;
use App\Services\Mail\MailService;
use Google\Client as GoogleClient;

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
            'subject' => 'Welcome to ASTPS',
            'data' => [
                'logo' => url("/assets/images/logo.png"),
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
            'auth_type' => $data['type'],
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
    public function login($request, $role)
    {
        $request->authenticate();
        if ($request->user()->hasRole($role)) {
            $token = $request->user()->createToken('auth_token');
            if ($request->fcmToken) {
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
            'email' => 'You do not have the required authorization.',
        ]);
    }

    /**
     * Social auth
     **/
    public function socialAuth($request, $role)
    {
        Log::alert($request->email);
        Log::alert($request->type);
        $user = User::where("email", $request->email)->first();
        if (!$user) {
            $userData = $this->createCustomer([
                'first_name' => $request->firstName,
                'last_name' => $request->lastName,
                'email' => $request->email,
                'telephone' => $request->telephone,
                'type' => $request->type,
                'password' => Hash::make(uniqid())
            ]);
            $user = $userData['user'];
        }

        if ($user) {
            return $this->login($request, $role);
        }

        throw ValidationException::withMessages([
            'email' => 'Login Faild.',
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
