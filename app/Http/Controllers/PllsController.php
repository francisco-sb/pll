<?php namespace App\Http\Controllers;

use App\Donor;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

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
        $donor = new Donor;
        $donor->name = $request->name;
        $donor->lastname = $request->lastname;
        $donor->email = $request->email;
        $donor->amount = $request->amount;
        $donor->save();

        \Stripe\Stripe::setApiKey ( 'sk_test_yourSecretkey' );
        try 
        {
            \Stripe\Charge::create (array(
                    "amount" => $request->amount,
                    "currency" => "mx", //Verificar la doc
                    "source" => $request->input ($request->stripeToken), // obtained with Stripe.js
                    "description" => "Pago del donante".$request->name.' '.$request->lastname
            ) );
        } 
        catch ( \Exception $e ) 
        {
		    return view('error');//retorna error de algun pago
	    }

        //retorna la vista de gratitud
        return view('succesfull');
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
