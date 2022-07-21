<?php

namespace App\Http\Controllers;

class MessageController extends Controller
{
    public function index()
    {
        return view('home.message', [
            'title' => __('titles.list', ['name' => 'messages'])
        ]);
    }
}
