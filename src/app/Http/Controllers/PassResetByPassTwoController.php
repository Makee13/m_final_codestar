<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class PassResetByPassTwoController extends Controller
{
    public function store(Request $request)
    {
        $email = $request->input('email');
        $password = $request->input('password');

        $user = User::where('email', $email)->firstOrFail();
        if (Hash::check($password, $user->password_level_2)) {
            Auth::attempt(['email' => $user->email, 'password' => $user->password]);

            return response()->json([
                'error' => false,
            ]);
        }

        return response()->json([
            'error' => true,
        ]);
    }
}
