<?php

namespace App\Http\Services\Product;

use Illuminate\Support\Facades\Auth;

class UploadService
{
    /**
     * Store image
     *
     * @param [Request] $request
     * @return path (store successfully) or false(fail store)
     */
    public function store($request)
    {
        if ($request->hasFile('image')) {
            try {
                $fileName = $request->file('image')->getClientOriginalName();

                $pathFull = join('', ['uploads/', Auth::id(), '/', date('Y-m-d')]);
                $path = $request->file('image')->storeAs('public/' . $pathFull, $fileName);

                return join('', ['/storage/', $pathFull, '/', $fileName]);
            } catch (\Exception $error) {
                return false;
            }
        }
    }
}