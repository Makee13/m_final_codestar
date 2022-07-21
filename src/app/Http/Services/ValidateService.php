<?php

namespace App\Http\Services;

use Illuminate\Http\Request;

trait ValidateService
{
    public $rules = [
        'name' => 'required|min:6|max:255',
        'email' => 'required|email|unique:users',
        'password' => 'required|min:6|max:20',
        'password_confirmation' => 'required|min:6|max:20|same:password',
        'repeat-password' => 'required|min:6|max:20|same:password',
        'new-password' => 'required|min:6|max:20',
        'confirm-password' => 'required|min:6|same:new-password',
        'phone' => 'required|regex:/^([0-9\s\-\+\(\)]*)$/|min:10|max:15|unique:users',
        'price' => 'required|numeric|min:0',
        'category' => 'required|numeric',
        'description' => 'required|min:6|max:255',
        'content' => 'required|min:6|max:255',
        'price_sale' => 'required|numeric|min:0',
        'file' => 'required',
        'url' => 'required:min:6',
        'thumb' => 'required',
        'sort_by' => 'required|numeric|min:0',
        'token' => 'required',
        'user_email' => 'required|email',
    ];

    public function validateService($request, $filteredInputs = [])
    {
        $inputs = $request->input();

        if (count($filteredInputs) > 0) {
            $inputs = $filteredInputs;
        }

        $validationArray = [];
        foreach ($inputs as $name => $value) {
            if (isset($this->rules[$name])) {
                $validationArray[$name] = $this->rules[$name];
            }
        }
        return $request->validate($validationArray);
    }
}
