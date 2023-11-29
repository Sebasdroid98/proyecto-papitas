<?php

namespace App\Http\Controllers;

use App\Custom\Queries\Clientes;
use App\Http\Requests\ClienteRequest;
use Illuminate\Http\Request;

class ClienteController extends Controller
{
    public $clienteQuery;

    public function __construct() {
        $this->middleware('auth');
        $this->clienteQuery = new Clientes();
    }

    /**
     * Función para mostrar el listado de empleados registrados
     */
    public function index() {
        $listaClientes = $this->clienteQuery->getListaClientes();
        return view('secciones-app.clientes.cliente-index', ['listaClientes' => $listaClientes]);
    }

    /**
     * Función para registrar a un nuevo empleado
     * @param ClienteRequest $request
     * @return View
     */
    public function store(ClienteRequest $request){
        $datosFormulario = $request->except('_token');
        $resultado = $this->clienteQuery->createCliente($datosFormulario);

        if ($resultado['process']) {
            return redirect()->route('clientes.index')->with('success', 'Cliente agregado exitosamente.');
        }

        return redirect()->route('clientes.index')->with('error', $resultado['message'])->withInput($datosFormulario);
    }
}
