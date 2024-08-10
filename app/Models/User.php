<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;

use App\Services\Mail\MailService;
use Laratrust\Traits\HasRolesAndPermissions;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Log;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Database\Eloquent\Relations\HasOne;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, HasRolesAndPermissions;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'first_name',
        'last_name',
        'email',
        'telephone',
        'email_verified_at',
        'remember_token',
        'password',
        'isDisable',
        'auth_type'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }
    
    public function fullName(): string
    {
        return $this->first_name . ' ' . $this->last_name;
    }

    public static function abort($status, $message = "User does not have any of the necessary access rights.")
    {
        return abort($status, $message);
    }

    public function fcmToken(): HasOne
    {
        return $this->hasOne(FcmToken::class);
    }



    public function sendPasswordResetNotification($token): void
    {
        $email = $this->getEmailForPasswordReset();
        $mailService = new MailService([
            'to' => $email,
            'layoutName' => 'email.reset-password-email',
            'subject' => 'Reset Password Notification - ASTPS',
            'data' => [
                'logo' => url("/assets/images/logo.png"),
                'email' => $email,
                'url' => url('/reset-password/'.$token.'/?email='.$email)
            ]
        ]);
        $mailService->send();
    }
}
