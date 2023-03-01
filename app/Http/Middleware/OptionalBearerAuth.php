<?php

namespace App\Http\Middleware;

use App\Models\User;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Laravel\Sanctum\PersonalAccessToken;

class OptionalBearerAuth
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        $bearer = $request->bearerToken();
        
        $token = PersonalAccessToken::query()->where('token', hash('sha256', explode('|',$bearer)[1] ?? ''))->first();
        
        if ($token && $user= \App\Models\User::find($token->tokenable_id))
        {
            $user->withAccessToken($token);
            Auth::login($user);
        }

        return $next($request);
    }
}
