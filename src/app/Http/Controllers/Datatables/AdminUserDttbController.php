<?php

namespace App\Http\Controllers\Datatables;

use App\Models\User;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Facades\DB;

class AdminUserDttbController
{
    const TEXT_TYPES = [
        User::BLOCK_STATUS => 'danger',
        User::NOT_BLOCK_STATUS => 'success',
    ];

    public function showAllUsers()
    {
        $query = DB::table('users')->where('roles', 'user');

        return DataTables::of($query)
                            ->addColumn('block-control', function ($user) {
                                $linkBlock = route('admin.users.update', ['id' => $user->id]);
                                $token = csrf_token();
                                return "<form action='$linkBlock' method='POST' class='d-flex'>
                                                <input type='hidden' name='_token' value='$token'>
                                                <textarea name='block_message' rows='2' placeholder='Blocking reason...'></textarea>
                                                <button class='btn-xs btn-danger'>Block user</button>
                                            </form>";
                            })
                            ->addColumn('unblock-control', function ($user) {
                                $linkUnBlock = route('admin.users.updateUnBlock', ['id' => $user->id]);
                                return "<a class='btn btn-success' href='$linkUnBlock'>Unblock user</a>";
                            })
                            ->addColumn('block-status', function ($user) {
                                $textType = self::TEXT_TYPES[$user->is_block];
                                $status = $user->is_block == '1' ? 'BLOCK' : 'IS_NOT_BLOCK';
                                return "<span class='text-$textType'>$status</span>";
                            })
                            ->rawColumns(['block-control', 'unblock-control', 'block-status'])
                            ->make(true);
    }
}
