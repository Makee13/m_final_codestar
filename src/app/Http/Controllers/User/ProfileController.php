<?php

namespace App\Http\Controllers\User;

use Exception;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Http\Services\ValidateService;
use App\Http\Requests\UpdateProfileRequest;

class ProfileController extends Controller
{
    use ValidateService;

    public function create(Request $request)
    {
        return view('profile.info', [
            'title' => 'Profile',
            'user' => Auth::user(),
        ]);
    }

    public function store(UpdateProfileRequest $request)
    {
        // Check if user changes phone and number
        $user = Auth::user();
        if ($request->input('phone') != $user->phone) {
            $request->validate(['phone' => 'unique:users']);
        }

        if ($request->input('email') != $user->email) {
            $request->validate(['email' => 'unique:users']);
        }

        try {
            $user->name     = $request->input('name');
            $user->email    = $request->input('email');
            $user->phone    = $request->input('phone');
            $user->province = $request->input('province');
            $user->district = $request->input('district');
            $user->commune  = $request->input('commune');
            $user->save();

            return back()->with('success', 'Update successfully');
        } catch (Exception $error) {
            return back()->withErrors('error', 'Please checking your informations');
        }
    }

    public function createCPass(Request $request)
    {
        return view('profile.change-password', [
            'title' => 'Change password',
            'user' => Auth::user(),
        ]);
    }

    public function storeCPass(Request $request)
    {
        $this->validateService($request, []);

        try {
            $user = Auth::user();
            $user->password = Hash::make($request->input('new-password'));
            $user->save();

        } catch (Exception $error) {
            return back()->withInput()->with('error', 'Update failed');
        }

        return back()->with('success', 'Update successfully');
    }

    public function createMoreSecure(Request $request)
    {
        return view('profile.more-secure', [
            'title' => 'More secure',
            'user' => Auth::user(),
        ]);
    }

    public function storeMoreSecure(Request $request)
    {
        $request->validate([
            'password' => 'required|min:6|max:20',
            'confirm-password' => 'required|min:6|same:password',
        ]);

        try {
            $user = Auth::user();
            $user->password_level_2 = Hash::make($request->input('password'));
            $user->save();

        } catch (Exception $error) {
            return back()->withInput()->with('error', 'Create failed');
        }

        return back()->with('success', 'Create successfully');
    }
}
