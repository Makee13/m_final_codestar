<?php

namespace App\Http\Controllers\Admin;

use Exception;
use App\Models\Slider;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Services\ValidateService;
use App\Http\Requests\Slider\SliderRequest;
use App\Http\Services\Slider\SliderAdminService;

class SliderController extends Controller
{
    protected $slider;
    use ValidateService;

    public function __construct(SliderAdminService $slider)
    {
        $this->slider = $slider;
    }

    public function create()
    {
        return view('admin.slider.add', ['title' => __('titles.add', ['name' => 'slider']),]);
    }

    public function index()
    {
        return view('admin.slider.list', [
            'title' => __('titles.list', ['name' => 'slider']),
            'sliders' => $this->slider->getWithPaginate(),
        ]);
    }

    public function show(Slider $slider)
    {
        return view('admin.slider.edit', [
            'title' => __('titles.edit', ['name' => 'slider']),
            'slider' => $slider,
        ]);
    }

    public function update(Request $request, Slider $slider)
    {
        $this->validateService($request);
        $result = $this->slider->store($request, $slider);

        if ($result) {
            return redirect()->route('admin.slider.list')->with('success', __('messages.succ-edit-mess', ['name' => 'slider']));
        }
        return back()->withInput()->withErrors(['error' => true]);
    }

    public function store(Request $request)
    {
        $this->validateService($request);
        $result = $this->slider->insert($request);

        if ($result) {
            return redirect()->back()->with('success', __('messages.succ-add-mess', ['name' => 'slider']));
        }
        return redirect()->back()->withInput()->withErrors(['error' => true]);
    }

    public function destroy(Request $request)
    {
        try {
            Slider::destroy($request->input('id'));

            return response()->json([
                'error' => false,
                'message' => __('messages.succ-del-mess', ['name' => 'slider']),
            ]);

        } catch (Exception $err) {
            throw new Exception($err->getMessage());
        }
    }
}
