<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\ApiController;

class ConverterController extends ApiController
{
    public function index()
    {
        return User::all();
    }

    public function store(Request $request)
    {
        try {
            $cuenta_id = User::find($request->input('id'));
            $balance_pesos = $cuenta_id->balance;
            $cuenta_id->balance = $cuenta_id->balance / 45;
            $cuenta_id->save();
            return ($this->sendResponse(["Balance en pesos" => '$' . $balance_pesos, "Balance en dolares" => 'USD' . $cuenta_id->balance], "Balance actualizado a dolares"));
        } catch (\Exception $e) {
            return $this->sendError($e, 'Error al realizar el cambio');
        }
    }

    public function show($id)
    {
        return User::find($id);
    }
}
