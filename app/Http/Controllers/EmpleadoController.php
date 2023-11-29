<?php

namespace App\Http\Controllers;

use App\Custom\Queries\Empleado;
use App\Custom\Queries\Usuarios;
use App\Http\Requests\EmpleadoRequest;
use App\Http\Requests\EmpleadoUpdateRequest;
use Illuminate\Http\Request;

class EmpleadoController extends Controller
{

    public $empleadoQuery;

    public function __construct() {
        $this->middleware('auth');
        $this->empleadoQuery = new Empleado();
    }

    /**
     * Función para mostrar el listado de empleados registrados
     */
    public function index() {
        $listaEmpleados = $this->empleadoQuery->getListaEmpleados();
        $listaCargos = [['id' => '1','nombre'=> 'Supervisor'],['id' => '2','nombre'=> 'Operario']];
        return view('secciones-app.empleados.empleado-index', ['listaEmpleados' => $listaEmpleados, 'listaCargos' => $listaCargos]);
    }

    public function edit(Int $id) {
        // dd($id);

        $infoEmpleado = $this->empleadoQuery->getInfoEmpleadoPorId($id);
        // dd($infoEmpleado);
        return redirect()->route('empleados.index')->with('data', $infoEmpleado);
    }

    /**
     * Función para registrar a un nuevo empleado
     * @param EmpleadoRequest $request
     * @return View
     */
    public function store(EmpleadoRequest $request){
        $datosCredenciales = $request->only('cargo','nombre','email','password');
        // dd($datosCredenciales);
        $datosFormulario = $request->except('_token','email','password');
        // dd($datosFormulario);
        $resultado = $this->empleadoQuery->createEmpleado($datosFormulario);

        if ($resultado['process']) {
            (new Usuarios)->createUser($datosCredenciales);
            return redirect()->route('empleados.index')->with('success', 'Empleado agregado exitosamente.');
        }

        return redirect()->route('empleados.index')->with('error', $resultado['message'])->withInput($datosFormulario);
    }

    /**
     * Función para registrar a un nuevo empleado
     * @param EmpleadoUpdateRequest $request
     * @return View
     */
    public function update(EmpleadoUpdateRequest $request, Int $id){
        $datosFormulario = $request->except('_token','_method');
        // dd($datosFormulario);
        $resultado = $this->empleadoQuery->updateEmpleado($datosFormulario);

        if ($resultado['process']) {
            return redirect()->route('empleados.index')->with('success', 'Empleado actualizado exitosamente.');
        }

        return redirect()->route('empleados.index')->with('error', $resultado['message'])->withInput($datosFormulario);
    }

    // public function delete(Int $id) {
    //     dd($id);
    // }
}
