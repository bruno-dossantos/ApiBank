<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class UserController extends ApiController
{
    public function index()
    {
        return User::all();
    }

    public function store(Request $request)
    {
        try {
            $User = new User();
            $User->name = $request->input('name');
            $User->email = $request->input('email');
            $User->password = $request->input('password');
            $User->amount = $request->input('amount');
            $User->save();
            return $this->sendResponse($User, "Cuenta creada correctamente");
        } catch (\Exception $e) {
            return $this->sendError("Error al crear cuenta", 200);
        }
    }

    public function show($id)
    {
        return User::find($id);
    }
}
