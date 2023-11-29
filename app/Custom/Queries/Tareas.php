<?php

namespace App\Custom\Queries;

use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\DB;

class Tareas
{
    /**
     * Query para consultar todos los registros de la tabla tareas
     */
    public function getListaTareas() {
        return DB::select("SELECT * FROM TAREAS TR INNER JOIN EMPLEADOS EM ON TR.EMP_ID = EM.EMP_ID  ORDER BY TAREA_ID DESC");
    }

    /**
     * Query para consultar todos los registros de la tabla tareas
     */
    public function getListaTareasEmpleado(Int $empleadoId) {
        return DB::select("SELECT * FROM TAREAS TR INNER JOIN EMPLEADOS EM ON TR.EMP_ID = EM.EMP_ID WHERE TR.EMP_ID = $empleadoId ORDER BY TAREA_ID DESC");
    }

    /**
     * Query para interactuar con el paquete "TAREAS_CRUD_PKG" y el procedimiento "CrearTarea"
     * @param Array $datos
     */
    public function createTarea(Array $datos) : Array{
        $rto = ['process' => false, 'message' => 'sin errores'];
        try{
            DB::statement('BEGIN TAREAS_CRUD_PKG.CrearTarea(:p_Tarea_Id, :p_Descripcion, :p_Fecha_Asignacion, :p_Emp_Id); END;', [
                'p_Tarea_Id'            => $datos['tarea_id'],
                'p_Descripcion'         => $datos['descripcion'],
                'p_Fecha_Asignacion'    => $datos['fecha_asignacion'],
                'p_Emp_Id'              => $datos['emp_id'],
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
