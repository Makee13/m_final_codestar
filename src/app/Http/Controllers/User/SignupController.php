<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Http\Services\ValidateService;
use App\Models\User;
use Exception;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class SignupController extends Controller
{
    use ValidateService;

    public function store(Request $request)
    {
        $credentials = $this->validateService($request);

        $credentials['password'] = Hash::make($credentials['password']);

        try {
            $user = User::create($credentials);

            $isRemembered = $request->input('remember') == 'on' ? true : false;

            Auth::attempt(['email' => $credentials['email'], 'password' => $request->input('password')], $isRemembered);

            // Send mail
            event(new Registered($user));

            return response()->json([
                'error' => false,
            ]);

        } catch (Exception $e) {
            return response()->json([
                'error' => $e->getMessage(),
            ]);
        }
    }
}
