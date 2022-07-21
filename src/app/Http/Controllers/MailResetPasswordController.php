<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Password;

class MailResetPasswordController extends Controller
{
    public function __invoke(Request $request)
    {
        /**
         * Send mail to reset password, include token
         * When a email is sent in password_resets table which is added a record,
         * store token, email, created_at
         * After user had reset password or set `$schedule->command('auth:clear-resets')->everyFifteenMinutes();` in schedule, The record removed,
         *
         * ---------------------------------
         * Reconfig link to reset password |
         * ---------------------------------
         * Link is able to reset in App\Provider\AuthServiceProvider->boot()
         */

        $request->validate(['email' => 'required|email']);

        // Send
        $status = Password::sendResetLink(
            $request->only('email')
        );

        // Response
        return $status === Password::RESET_LINK_SENT
            ? response()->json(['status' => __($status)])
            : back()->withErrors(['email' => __($status)]);
    }
}
