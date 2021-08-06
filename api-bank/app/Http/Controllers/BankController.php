<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class BankController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $Bank = Pelicula::where('activo', '=', 1)
            ->select('idPelicula', 'nombre', 'img')
            ->get();

        return $this->sendResponse($Bank, "Peliculas obtenidas correctamente");
        // return $this->sendError("Error Conocido", "Error controlado", 200);
    }
    public function store(Request $request)
    {
        try {
            $Bank = new Pelicula();
            $Bank->nombre = $request->input('img');
            $Bank->img = $request->input('nombre');
            $Bank->save();
            return $this->sendResponse($Bank, "Pelicula ingresada correctamente");
        } catch (Exception $e) {
            return $this->sendError("Error Conocido", "Error al crear la Pelicula", 200);
        }
    }
    public function show($id)
    {
        $Bank = Pelicula::where('idPelicula', $id)
            ->select('idPelicula', 'nombre', 'img')
            ->get();
        return $this->sendResponse($Bank, "Pelicula obtenida correctamente");
    }
}
