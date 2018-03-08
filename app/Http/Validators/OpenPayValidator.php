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
            'amount' => 'required',
        ];

        $message = [
            'name.required' => 'Nombre requerido',
            'lastname.required' => 'Apellido requerido',
            'email.required' => 'Correo electrónico requerido',
            'holder_name.required' => 'Nombre del titular requerido',
            'cvv2.required' => 'Código de seguridad requerido',
            'card_number.required' => 'Número de tarjeta requerido',
            'expiration_month.required' => 'Mes requerido',
            'expiration_year.required' => 'Año requerido',
            'amount.required' => 'Cantidad requerida'
        ];

        $validator = Validator::make($request->all(), $rules, $message);
        return $validator;
    }

}
