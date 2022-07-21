<?php

namespace App\Http\Controllers\Datatables;

use Illuminate\Support\Facades\DB;
use Yajra\DataTables\DataTables;

class AdminNotificationDttbController
{
    public function showAll()
    {
        $query = DB::table('notifications');

        return DataTables::of($query)
                            ->addColumn('update', function ($notification) {
                                return '<a href="' . route('admin.notifications.edit', $notification->id) . '" class="btn btn-primary"><i class="glyphicon glyphicon-edit"></i>Update</a>';
                            })
                            ->addColumn('destroy', function ($notification) {
                                return '<a href="' . route('admin.notifications.destroy', ['notification' => $notification->id]) . '" class="btn btn-danger"><i class="glyphicon glyphicon-edit"></i>Destroy</a>';
                            })
                            ->rawColumns(['update', 'destroy'])
                            ->make(true);
    }
}
