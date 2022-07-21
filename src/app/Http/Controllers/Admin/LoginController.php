<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\AdminLoginRequest;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function create()
    {
        return view('admin.users.login', [
            'title' => 'Login',
        ]);
    }

    public function store(AdminLoginRequest $request)
    {
        $credentials = $request->validated();

        if (Auth::attempt($credentials, $request->remember)) {
            return redirect()->route('admin');
        }

        return back()->withErrors(['error' => __('messages.err-signin-mess')]);
    }
}
