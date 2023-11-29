<?php

namespace App\Custom\Queries;

use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\DB;

class Ventas
{
    /**
     * Query para consultar todos los registros de la tabla ventas
     */
    public function getListaVentas() {
        return DB::select("SELECT * FROM VENTAS VT INNER JOIN CLIENTES CT ON VT.CLIENTE_ID = CT.CLIENTE_ID INNER JOIN PAPITASFRITAS PPF ON VT.PAPITAFRITA_ID = PPF.PAPITAFRITA_ID ORDER BY VENTA_ID DESC");
    }

    /**
     * Query para interactuar con el paquete "VENTAS_CRUD_PKG" y el procedimiento "CrearVenta"
     * @param Array $datos
     */
    public function createVenta(Array $datos) : Array{
        $rto = ['process' => false, 'message' => 'sin errores'];
        try{
            DB::statement('BEGIN VENTAS_CRUD_PKG.CrearVenta(:p_Venta_Id, :p_Cliente_Id, :p_Fecha_Venta, :p_PapitaFrita_Id, :p_Cantidad, :p_PrecioUnitario); END;', [
                'p_Venta_Id'        => $datos['venta_id'],
                'p_Cliente_Id'      => $datos['cliente_id'],
                'p_Fecha_Venta'     => $datos['fecha_venta'],
                'p_PapitaFrita_Id'  => $datos['papitafrita_id'],
                'p_Cantidad'        => $datos['cantidad'],
                'p_PrecioUnitario'  => $datos['precio_unitario'],
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
