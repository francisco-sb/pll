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
        // try
        // {
        //     Openpay::setProductionMode(false);
        //     $openpay = Openpay::getInstance('mnfv5dmxgwgvxdjstxng', 'sk_70f2c7afaa854d4bb9b160653fd4c263');
        //
        //     $customer = array(
        //         'name' => $request->name,
        //         'last_name' => $request->lastname,
        //         'email' => $request->email);
        //
        //     $chargeData = array(
        //         'method' => 'card',
        //         'source_id' => $request->token_id,
        //         // 'amount' => (float)$request->amount, --Poner el amount
        //         'amount' => (float)100,
        //         'description' => "Donación por la persona: ".$request->name,
        //         'device_session_id' => $request->deviceIdHiddenFieldName,
        //         'customer' => $customer
        //         );
        //
        //     $charge = $openpay->charges->create($chargeData);
        //
        //     //Si no existe error, guardamos el donante.
        //     $donor = new Donor;
        //     $donor->name = $request->name;
        //     $donor->lastname = $request->lastname;
        //     $donor->email = $request->email;
        //     $donor->amount = (float) 0;//$request->amount; --Poner el amount
        //     $donor->save();
        //
        // } catch (OpenpayApiTransactionError $e) {
        //   	$message = 'ERROR en la transacción: ' . $e->getMessage() .
        //   	      ' [error code: ' . $e->getErrorCode() .
        //   	      ', error category: ' . $e->getCategory() .
        //   	      ', HTTP code: '. $e->getHttpCode() .
        //   	      ', request ID: ' . $e->getRequestId() . ']';
        //
        //           return view('fail', ['status' => 2,
        //                                 'message' => $message]);
        // } catch (OpenpayApiRequestError $e) {
        // 	  $message = 'ERROR en la solicitud: ' . $e->getMessage();
        //     return view('fail', ['status' => 2,
        //                           'message' => $message]);
        // } catch (OpenpayApiConnectionError $e) {
        // 	  $message = 'ERROR al conectarse con la API de Openpay: ' . $e->getMessage();
        //     return view('fail', ['status' => 2,
        //                           'message' => $message]);
        // } catch (OpenpayApiAuthError $e) {
        // 	  $message = 'ERROR de autenticación: ' . $e->getMessage();
        //     return view('fail', ['status' => 2,
        //                           'message' => $message]);
        // } catch (OpenpayApiError $e) {
        // 	  $message = 'ERROR en la API: ' . $e->getMessage();
        //     return view('fail', ['status' => 2,
        //                           'message' => $message]);
        // } catch (Exception $e) {
        //   	$message = 'Error en el script: ' . $e->getMessage();
        //     //fail
        //     return view('fail', ['status' => 2,
        //                           'message' => $message]);
        // }
        // //success
        // return view('success', ['status' => 1,
        //                       'message' => '¡Gracias por tu donativo!']);
        return 'Redireccionado';
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
