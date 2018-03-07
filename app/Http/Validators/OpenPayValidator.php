<?php namespace App\Http\Validators;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class OpenPayValidator
{
    public function RequestValidator(Request $request) 
    {
        $rules = [
            'name' => 'required',
        ];

        $message = [
            'name.required' => 'El nombre es requerido',
        ];

        $validator = Validator::make($request->all(), $rules, $message);
        return $validator;
    }

}