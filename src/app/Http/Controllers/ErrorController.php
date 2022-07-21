<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ErrorController extends Controller
{
    public function show(Request $request)
    {
        return view('error.common-error', [
            'title' => 'Error',
            'message' => $request->input('message'),
            'contentError' => $request->input('message'),
        ]);
    }
}
