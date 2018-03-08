<?php namespace App\Http\Validators;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class OpenPayValidator
{
    public function RequestValidator(Request $request)
    {
        $rules = [
            'name' => 'required',
            'lastname' => 'required',
            'email' => 'required',
            'holder_name' => 'required',
            'cvv2' => 'required',
            'card_number' => 'required',
            'expiration_month' => 'required',
            'expiration_year' => 'required',
        ];

        $message = [
            'name.required' => 'Nombre es requerido',
            'lastname.required' => 'Apellido es requerido',
            'email.required' => 'Correo electrónico es requerido',
            'holder_name.required' => 'Nombre del titular es requerido',
            'cvv2.required' => 'Código de seguridad es requerido',
            'card_number.required' => 'Número de tarjeta es requerido',
            'expiration_month.required' => 'Mes es requerido',
            'expiration_year.required' => 'Año es requerido',
        ];

        $validator = Validator::make($request->all(), $rules, $message);
        return $validator;
    }

}
