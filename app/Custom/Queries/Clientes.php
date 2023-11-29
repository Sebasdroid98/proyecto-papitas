<?php

namespace App\Custom\Queries;

use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\DB;

class Clientes
{
    /**
     * Query para consultar todos los registros de la tabla clientes
     */
    public function getListaClientes() {
        return DB::select("SELECT * FROM CLIENTES ORDER BY CLIENTE_ID DESC");
    }

    /**
     * Query para interactuar con el paquete "CLIENTES_CRUD_PKG" y el procedimiento "CrearCliente"
     * @param Array $datos
     */
    public function createCliente(Array $datos) : Array{
        $rto = ['process' => false, 'message' => 'sin errores'];
        try{
            DB::statement('BEGIN CLIENTES_CRUD_PKG.CrearCliente(:p_Cliente_Id, :p_Nombre, :p_Direccion); END;', [
                'p_Cliente_Id'  => $datos['cliente_id'],
                'p_Nombre'      => $datos['nombre'],
                'p_Direccion'   => $datos['direccion'],
            ]);

            $rto['process'] = true;
            $rto['message'] = 'Registro exitoso';
            return $rto;

        }catch (QueryException $e) {
            // Captura excepciones específicas relacionadas con la base de datos

            // Obtenemos el código de error
            $errorCode = $e->getCode();

            // Obtenemos el mensaje de error
            $errorMessage = $e->getMessage();

            if (strpos($errorMessage, 'ORA-20001') !== false) {
                $rto['message'] = $errorMessage;
                return $rto;
            } else {
                $rto['message'] = $errorMessage;
                return $rto;
            }
        }
        return [];
    }

}
