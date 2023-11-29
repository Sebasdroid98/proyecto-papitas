<?php

namespace App\Http\Controllers;

use App\Custom\Queries\Clientes;
use App\Custom\Queries\PapitasFritas;
use App\Custom\Queries\Ventas;
use App\Http\Requests\VentaRequest;
use Illuminate\Http\Request;

class VentaController extends Controller
{
    public $ventasQuery;

    public function __construct() {
        $this->middleware('auth');
        $this->ventasQuery = new Ventas();
    }

    /**
     * Función para mostrar el listado de empleados registrados
     */
    public function index() {
        $listaVentas = $this->ventasQuery->getListaVentas();
        $listaClientes = (new Clientes)->getListaClientes();
        $listaPapitasFritas = (new PapitasFritas)->getListaPapitas();
        return view('secciones-app.ventas.venta-index', [
            'listaVentas' => $listaVentas, 
            'listaClientes' => $listaClientes,
            'listaPapitasFritas' => $listaPapitasFritas,
        ]);
    }

    /**
     * Función para registrar a un nuevo empleado
     * @param VentaRequest $request
     * @return View
     */
    public function store(VentaRequest $request){
        $datosFormulario = $request->except('_token');
        // dd($datosFormulario);
        $resultado = $this->ventasQuery->createVenta($datosFormulario);

        if ($resultado['process']) {
            return redirect()->route('ventas.index')->with('success', 'Venta agregada exitosamente.');
        }

        return redirect()->route('ventas.index')->with('error', $resultado['message'])->withInput($datosFormulario);
    }
}
