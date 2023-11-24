<?php

namespace App\Http\Controllers;

use App\Custom\Queries\Empleado;
use Illuminate\Http\Request;

class EmpleadoController extends Controller
{

    public function __construct() {
        $this->middleware('auth');
    }

    /**
     * Función para mostrar el listado de empleados registrados
     */
    public function index() {
        $listaEmpleados = (new Empleado)->getListaEmpleados();
        return view('secciones-app.empleados.empleado-index', ['listaEmpleados' => $listaEmpleados]);
    }
}
