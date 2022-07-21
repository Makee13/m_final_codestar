<?php

namespace App\Http\Middleware;

use Closure;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminAuthenticate
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle($request, Closure $next)
    {
        $user = Auth::user();
        if (!isset($user)) {
            return redirect()->route('admin.login.create');
        }

        if ($user->roles !== User::ADMIN_ROLE) {
            return redirect()->route('admin.login.create')->withErrors(['error' => 'An error occurred, please check the information again']);
        }
        return $next($request);
    }
}