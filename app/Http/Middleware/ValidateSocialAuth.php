<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use App\Models\User;
use Illuminate\Validation\ValidationException;

class ValidateSocialAuth
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, $rolesJson): Response
    {
        $roles = json_decode($rolesJson, true);
        $user = User::where('email', $request->email)->first();
        if ($user) {
            if ($user && $user->isDisable) {
                throw ValidationException::withMessages([
                    'email' => 'This account is currently disabled.',
                    'isUser' => true
                ]);
            } elseif (!$user->hasRole($roles)) {
                throw ValidationException::withMessages([
                    'email' => 'You do not have the required authorization.',
                    'isUser' => true
                ]);
            }
        }
        return $next($request);
    }
}
