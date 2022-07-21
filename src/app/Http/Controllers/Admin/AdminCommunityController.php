<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AdminCommunityController extends Controller
{
    public function __invoke()
    {
        return view('admin.community', [
            'title' => __('titles.list', ['name' => 'comment'])
        ]);
    }
}
