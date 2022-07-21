<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Http\Request;

class EmailVerificationController extends Controller
{
    public function verify(EmailVerificationRequest $request)
    {
        $request->fulfill();

        return redirect()->route('user.profile.info.create');
    }

    public function send(Request $request)
    {
        $request->user()->sendEmailVerificationNotification();

        return view('auth.verify-email', [
            'title' => 'Send verification',
            'noticeTitle' => 'Confirm your email address',
            'link' => '',
            'control' => 'Resend to confirm email',
            'message' => 'Verification link sent to <b style="text-decoration: underline;">' . $request->user()->email . '</b>',
        ]);
    }
}
