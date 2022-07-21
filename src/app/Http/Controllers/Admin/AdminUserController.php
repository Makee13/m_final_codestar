<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class AdminUserController extends Controller
{
    public function index()
    {
        return view('admin.users.list', [
            'title' => __('titles.list', ['name' => 'users']),
        ]);
    }

    public function update(Request $request)
    {
        $request->validate(['block_message' => 'required']);
        $user = User::find($request->input('id'));

        try {
            $user->is_block = User::BLOCK_STATUS;
            $user->block_message = $request->input('block_message');
            $user->save();

        } catch (Exception $err) {
            Log::channel('sql')->error('Update user block status', [$err->getMessage()]);
            throw new Exception($err->getMessage());
        }

        return back()->with([
            'success' => true,
            'message' => __('messages.succ-update-mess', ['name' => 'user']),
        ]);
    }

    public function updateUnBlock(Request $request)
    {
        $user = User::find($request->input('id'));
        try {
            $user->is_block = User::NOT_BLOCK_STATUS;
            $user->block_message = '';
            $user->save();

        } catch (Exception $err) {
            Log::channel('sql')->error('Update user unblock status', [$err->getMessage()]);
            throw new Exception($err->getMessage());
        }

        return back()->with([
            'success' => true,
            'message' => __('messages.succ-update-mess', ['name' => 'user']),
        ]);
    }
}
