<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Action;
use Illuminate\Http\Request;
use App\Http\Controllers\ApiController;


class ActionController extends ApiController
{
    public function index()
    {
        return Action::all();
    }

    public function store(Request $request)
    {
        switch (strtolower($request->input('tipo-accion'))) {
            case 'retiro':
                try {
                    $cuenta_origen = User::find($request->input('cuenta-origen'));

                    if ($cuenta_origen->balance >= $request->input('balance') && $request->input('balance') > 1000) {
                        $cuenta_origen->balance = $cuenta_origen->balance - $request->input('balance');

                        $action = Action::create($request->all());

                        $cuenta_origen->save();
                        $action->save();

                        return $this->sendResponse($action, 'Retiro exitoso', 200);
                    } else {
                        return $this->sendError('Error monto', 'Cuenta origen no cuenta con determinado monto');
                    }
                } catch (\Exception $e) {
                    return $this->sendError($e, 'Error al realizar el retiro');
                }
                break;

            case 'transferir':
                try {
                    $cuenta_origen = User::find($request->input('cuenta-origen'));
                    $cuenta_destino = User::find($request->input('cuenta-destino'));

                    if ($cuenta_origen->balance >= $request->input('balance') && $request->input('balance') > 1000) {
                        $cuenta_origen->balance = $cuenta_origen->balance - $request->input('balance');
                        $cuenta_destino->balance = $cuenta_destino->balance + $request->input('balance');

                        $action = Action::create($request->all());

                        $cuenta_origen->save();
                        $cuenta_destino->save();
                        $action->save();

                        return $this->sendResponse($action, 'Transferencia exitosa');
                    } else {
                        return $this->sendError('Error de monto', 'Cuenta origen no cuenta con determinado monto');
                    }
                } catch (\Exception $e) {
                    return $this->sendError($e, 'Error al realizar la transferencia');
                }
                break;

            case 'deposito':
                try {
                    $cuenta_origen = User::find($request->input('cuenta-origen'));
                    $cuenta_origen->balance = $cuenta_origen->balance + $request->input('balance');

                    $action = Action::create($request->all());

                    $cuenta_origen->save();
                    $action->save();

                    return $this->sendResponse($action, 'Deposito exitoso');
                } catch (\Exception $e) {
                    return $this->sendError($e, 'Error al realizar el deposito');
                }
                break;
            default:
                return $this->sendError('Error de tipo', 'Tipo de evento inexistente');
        }
    }

    public function show($id)
    {
        return Action::find($id);
    }
}
