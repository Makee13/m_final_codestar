<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Services\Product\UploadService;
use App\Http\Services\ValidateService;
use Illuminate\Http\Request;

class UploadImageController extends Controller
{
    protected $uploadService;
    use ValidateService;

    public function __construct(UploadService $uploadService)
    {
        $this->uploadService = $uploadService;
    }

    public function store(Request $request)
    {
        $this->validateService($request);
        $urlImage = $this->uploadService->store($request);

        if ($urlImage) {
            return response()->json([
                'error' => false,
                'urlImage' => $urlImage,
            ]);
        }
        return response()->json(['error' => true]);
    }
}
