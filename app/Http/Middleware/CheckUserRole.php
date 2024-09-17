<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use App\Models\User;
use Illuminate\Validation\ValidationException;

class CheckUserRole
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next,string $role): Response
    {
        $user = User::where('email', $request->email)->first();
        if ($user) {
            if ($user && $user->isDisable) {
                throw ValidationException::withMessages([
                    'email' => 'This account is currently disabled.'
                ]);
            } elseif ($user->hasRole($role)) {
                return $next($request);
            } else {
                throw ValidationException::withMessages([
                    'email' => 'You do not have the required authorization.'
                ]);
            }
        } else {
            throw ValidationException::withMessages([
                'email' => 'The selected email is invalid'
            ]);
        }
    }
}
