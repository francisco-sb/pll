<?php namespace App\Http\Controllers;

use Openpay;
use App\Donor;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Http\Controllers\Controller;
use App\Http\Validators\OpenPayValidator;

class PllsController extends Controller {

    public function all()
    {
        return "All Donantes";
    }

    public function get(Request $request)
    {
        try
        {
            Openpay::setProductionMode(false);
            $openpay = Openpay::getInstance('mnfv5dmxgwgvxdjstxng', 'sk_70f2c7afaa854d4bb9b160653fd4c263');

            $charge = $openpay->charges->get($request->id);
            $status = $charge->status;
            if ($status == 'completed') {
                $message = 'Transacción exitosa, gracias por tu aportación.';
            } else if ($status == 'failed'){
                $message = 'Tu transacción falló... Error: '.$charge->error_message;
            }
        } catch (\Exception $e) {
            $message = 'Error: ' . $e->getMessage();
        }

        return response()->json(['status' => $status,
                                 'charge' => $message]);
    }

    public function add(Request $request)
    {
        if ($request->isMethod('post'))
        {
            $openValidator = new OpenPayValidator;
            $validator = $openValidator->RequestValidator($request);

            if ($validator->passes())
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
                        'amount' => (float)$request->amount,
                        'description' => "Donación por la persona: ".$request->name,
                        'source_id' => $request->token_id,
                        'redirect_url' => 'https://www.por-lalibre.com/',
                        'use_3d_secure' => 'true',
                        'device_session_id' => $request->deviceIdHiddenFieldName,
                        'customer' => $customer
                        );

                    $charge = $openpay->charges->create($chargeData);

                    // Si no existe error, guardamos el donante.
                    $donor = new Donor;
                    $donor->name = $request->name;
                    $donor->lastname = $request->lastname;
                    $donor->email = $request->email;
                    $donor->amount = (float)$request->amount;
                    $donor->save();

                } catch (\OpenpayApiTransactionError $e) {
                  	$message = 'ERROR en la transacción: ' . $e->getMessage() .
                  	      ' [error code: ' . $e->getErrorCode() .
                  	      ', error category: ' . $e->getCategory() .
                  	      ', HTTP code: '. $e->getHttpCode() .
                  	      ', request ID: ' . $e->getRequestId() . ']';
                    return response()->json(['error' => $message]);

                } catch (\OpenpayApiRequestError $e) {
                	  $message = 'ERROR en la solicitud: ' . $e->getMessage();
                    return response()->json(['error' => $message]);

                } catch (\OpenpayApiConnectionError $e) {
                	  $message = 'ERROR al conectarse con la API de Openpay: ' . $e->getMessage();
                    return response()->json(['error' => $message]);

                } catch (\OpenpayApiAuthError $e) {
                	  $message = 'ERROR de autenticación: ' . $e->getMessage();
                    return response()->json(['error' => $message]);

                } catch (\OpenpayApiError $e) {
                	  $message = 'ERROR en la API: ' . $e->getMessage();
                    return response()->json(['error' => $message]);

                } catch (\Exception $e) {
                  	$message = 'Error: ' . $e->getMessage();
                    return response()->json(['error' => $message]);

                }

                return response()->json(['success' => $charge->payment_method->url]);
            }

            return response()->json(['errors_form' => $validator->errors()]);
        }
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
