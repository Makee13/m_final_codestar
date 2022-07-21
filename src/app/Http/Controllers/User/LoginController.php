<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{

    public function index()
    {
        return view('common.sign', [
            'title' => 'Login And Signup',
        ]);
    }

    public function store(Request $request)
    {
        $email = $request->input('email');
        $password = $request->input('password');
        $isRemembered = $request->input('remember') == 'on' ? true : false;

        if (Auth::attempt(['email' => $email, 'password' => $password], $isRemembered)) {
            $email_verified_at = Auth::user()->email_verified_at;

            if ($email_verified_at !== null) {
                return response()->json([
                    'error' => false,
                ]);
                
            } else {
                // Reponse email to send verify email
                return response()->json([
                    'error' => true,
                    'email' => $email,
                ]);
            }
        }

        return response()->json([
            'error' => true,
            'message' => __('Email or password is incorrect!')
        ]);
    }
}
