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
