<?php

namespace App\Http\Services;

use Throwable;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Services\ValidateService;

trait Service
{
    public function create($model, $inputs)
    {
        try {
            return $model::create($inputs);
        } catch (Throwable $e) {
            report($e);
            return $e->getMessage();
        }
    }

    public function readWithActive($model, $isActive = false)
    {
        try {
            return $model::where('active', $isActive)->get();
        } catch (Throwable $e) {
            report($e);
            return null;
        }
    }

    public function update($model, $inputs)
    {
        try {
            $model->update($inputs);
            return true;
        } catch (Throwable $e) {
            report($e);
            return false;
        }
    }

    public function delete($model, $id)
    {
        try {
            $object = $model::find($id);
     
            return $object->delete();
        } catch (Throwable $e) {
            report($e);
            return $e;
        }
    }
}
