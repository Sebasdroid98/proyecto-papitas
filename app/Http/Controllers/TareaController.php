<?php

namespace App\Http\Controllers;

use App\Custom\Queries\Empleado;
use App\Custom\Queries\Tareas;
use App\Http\Requests\TareaRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TareaController extends Controller
{
    public $tareasQuery;

    public function __construct() {
        $this->middleware('auth');
        $this->tareasQuery = new Tareas();
    }

    /**
     * Función para mostrar el listado de empleados registrados
     */
    public function index() {

        if (Auth::user()->rol == '2') {
            $empID = Auth::user()->empid;
            // dd(Auth::user());
            $listaTareas = $this->tareasQuery->getListaTareasEmpleado($empID);
        }else{
            $listaTareas = $this->tareasQuery->getListaTareas();
        }

        $listaEmpleados = (new Empleado)->getListaEmpleados();
        return view('secciones-app.tareas.tarea-index', ['listaTareas' => $listaTareas, 'listaEpleados' => $listaEmpleados]);
    }

    /**
     * Función para registrar a un nuevo empleado
     * @param TareaRequest $request
     * @return View
     */
    public function store(TareaRequest $request){
        $datosFormulario = $request->except('_token');
        $resultado = $this->tareasQuery->createTarea($datosFormulario);

        if ($resultado['process']) {
            return redirect()->route('tareas.index')->with('success', 'Tarea agregada exitosamente.');
        }

        return redirect()->route('tareas.index')->with('error', $resultado['message'])->withInput($datosFormulario);
    }
}
