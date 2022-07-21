<?php

namespace App\Http\Controllers;

use App\Http\Requests\PassResetByMailRequest;
use App\Http\Services\ValidateService;
use Illuminate\Auth\Events\PasswordReset;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Str;

class PassResetByMailController extends Controller
{
    use ValidateService;

    public function create(Request $request)
    {
        return view('auth.reset-password', ['token' => $request->token]);
    }

    public function store(PassResetByMailRequest $request)
    {
        // Reset password
        $status = Password::reset(
            $request->only('email', 'password', 'password_confirmation', 'token'),
            
            function ($user, $password) {
                $user->forceFill([
                    'password' => Hash::make($password),
                ])->setRememberToken(Str::random(60));

                $user->save();

                event(new PasswordReset($user));
            }
        );

        // Response
        return $status === Password::PASSWORD_RESET
            ? redirect()->route('user.sign')->with('status', __($status))
            : back()->withErrors(['email' => [__($status)]]);
    }

}
