<?php namespace App\Http\Controllers;

use App\Donor;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Openpay;

class PllsController extends Controller {

    public function all()
    {
        return "All Donantes";
    }

    public function get(Request $request)
    {
        return "Get donante";
    }

    public function add(Request $request)
    {
        try
        {
            Openpay::setProductionMode(false);
            $openpay = Openpay::getInstance('mnfv5dmxgwgvxdjstxng', 'sk_70f2c7afaa854d4bb9b160653fd4c263');

            $customer = array(
                'name' => $request->name,
                'last_name' => $request->lastname,
                'email' => $request->email);

            $chargeData = array(
                'method' => 'card',
                'source_id' => $request->token_id,
                // 'amount' => (float)$request->amount, --Poner el amount
                'amount' => (float)100,
                'description' => "Donación por la persona: ".$request->name,
                'device_session_id' => $request->deviceIdHiddenFieldName,
                'customer' => $customer
                );

            $charge = $openpay->charges->create($chargeData);
            //Si no existe error, guardamos el donante.
            $donor = new Donor;
            $donor->name = $request->name;
            $donor->lastname = $request->lastname;
            $donor->email = $request->email;
            $donor->amount = (float) 0;//$request->amount; --Poner el amount
            $donor->save();
        } catch (Exception $e) {

            //En este se implementará todos los tipos de excepciones y eliminas las otras de arriba
            switch ($$e->getErrorCode()) {
                case '1000': //Es de la lista de errores, digo que aqui agreges solo los de las transacciones
                    $message = 'Ha ocurrido un error en el servidor de OpenPay';
                    break;
                case '502':
                    $message = 'El servicio de pago no se encuentra disponible por el momento, por favor intenta más tarde'
                    break;
                case '3001':
                    $message = 'Tu tarjeta fue declinada'
                    break;
                case '3002':
                    $message = 'Tu tarjeta ha expirado'
                    break;
                case '3003':
                    $message = 'Tu tarjeta no cuenta con los suficientes fondos'
                    break;
                case '3004':
                    $message = 'Procesaste un cargo con una tarjeta reportada como robada'
                    break;
                case '3005':
                    $message = 'Tu tarjeta fue rechazada por el sistema antifraudes'
                    break;
                case '3007':
                    $message = 'Tu tarjeta fue rechazada'
                    break;
                case '3008':
                    $message = 'Tu tarjeta no soporta transacciones online'
                    break;
                case '3009':
                    $message = 'Procesaste un cargo con una tarjeta reportada como perdida'
                    break;
                case '3010':
                    $message = 'Tarjeta bloqueada por el banco'
                    break;
                case '3002':
                    $message = 'Tarjeta declinada'
                    break;
                case '3012':
                    $message = 'Se requiere autorización del banco'
                    break;
                default:
                    $message = 'Lo sentimos, ocurrió un error con tu transacción...'
                    break;
            }

            return view('index', ['status' => false,
                                  'message' => $message]);
        }

        //retorna la vista de gratitud
        return view('index', ['status' => true,
                              'message' => '¡Gracias por tu donativo!']);
    }

    public function put(Request $request)
    {
        return "Actualizar donante";
    }

    public function remove(Request $request)
    {
        return "Eliminar donante";
    }

}
