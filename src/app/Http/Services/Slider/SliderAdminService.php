<?php

namespace App\Http\Services\Slider;

use App\Models\Slider;
use App\Http\Services\Service;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;

class SliderAdminService
{
    const DEFAULT_PAGINATE_AMOUNT = 20;
    use Service;

    public function insert($request)
    {
        try {
            $request['active'] = $request->active === 'on' ? '1' : '0';
            $this->create(Slider::class, $request->input());
            return true;
        } catch (\Exception $error) {
            Log::info($error->getMessage());
            return false;
        }
    }

    /**
     * Get sliders with paginate amount or default paginate value which is 20
     *
     * @param [number] $amount
     * @return array
     */
    public function getWithPaginate($amount = null)
    {
        return Slider::where('active', '1')->paginate($amount ?? self::DEFAULT_PAGINATE_AMOUNT);
    }

    public function store($request, $slider)
    {
        try {
            $request['active'] = $request->active === 'on' ? '1' : '0';
            $this->update($slider, $request->input());
            return true;
        } catch (\Exception $error) {
            Log::info($error->getMessage());
            return false;
        }
    }

    public function delete($request)
    {
        $slider = Slider::where('id', $request->input('id'))->first();
        if ($slider) {
            $path = str_replace('storage', 'public', $slider->thumb);
            Storage::delete($path);
            $slider->delete();
            return true;
        }
        return false;
    }

    /**
     * Get all sliders with sorted ASC
     *
     * @return array
     */
    public function showBySorted()
    {
        return Slider::where('active', '1')->orderBy('sort_by', 'ASC')->get();
    }
}