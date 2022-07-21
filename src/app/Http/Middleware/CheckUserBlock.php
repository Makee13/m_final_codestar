<?php

namespace App\Http\Middleware;

use App\Models\User;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CheckUserBlock
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
        $blockedUser = User::getBlockedUser($request->input('email'));

        if ($blockedUser) {
            return response()->json([
                'error' => true,
                'message' => __("The account is blocked because $blockedUser->block_message, Please contact administrator to be supported"),
            ]);
        }

        $logedUser = Auth::user();
        if ($logedUser && $logedUser->is_block == User::BLOCK_STATUS) {

            Auth::logout();
            $request->session()->invalidate();
            $request->session()->regenerateToken();

            return redirect()->route('error.show', [
                'message' => 'Account is blocked',
                'contentMessage' => $logedUser->block_message,
            ]);

        }

        return $next($request);
    }
}
