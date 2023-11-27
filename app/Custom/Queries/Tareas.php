<?php

namespace App\Custom\Queries;

use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\DB;

class Tareas
{
    /**
     * Query para consultar todos los registros de la tabla empleado
     */
    public function getListaTareas() {
        return DB::select("SELECT * FROM TAREAS ORDER BY EMP_ID DESC");
    }

    /**
     * Query para interactuar con el paquete "EMPLEADO_CRUD_PKG" y el procedimiento "CrearEmpleado"
     * @param Array $datos
     */
    public function createTarea(Array $datos) : Array{
        $rto = ['process' => false, 'message' => 'sin errores'];
        // try{
        //     DB::statement('BEGIN EMPLEADO_CRUD_PKG.CrearEmpleado(:p_emp_id, :p_emp_nombre, :p_emp_cargo, :p_emp_salario); END;', [
        //         'p_emp_id'      => $datos['emp_id'],
        //         'p_emp_nombre'  => $datos['nombre'],
        //         'p_emp_cargo'   => $datos['cargo'],
        //         'p_emp_salario' => $datos['salario'],
        //     ]);

        //     $rto['process'] = true;
        //     $rto['message'] = 'Registro exitoso';
        //     return $rto;

        // }catch (QueryException $e) {
        //     // Captura excepciones específicas relacionadas con la base de datos

        //     // Obtenemos el código de error
        //     $errorCode = $e->getCode();

        //     // Obtenemos el mensaje de error
        //     $errorMessage = $e->getMessage();

        //     if (strpos($errorMessage, 'ORA-20001') !== false) {
        //         $rto['message'] = $errorMessage;
        //         return $rto;
        //     } else {
        //         $rto['message'] = $errorMessage;
                return $rto;
        //     }
        // }
        // return [];
    }

    /**
     * Query para obtener la informacion de un empleado por su id
     * @param Int $emp_id
     */
    public function getInfoEmpleadoPorId(Int $emp_id) {
        // return ModelsEmpleado::findOrFail($emp_id);
        // $rto = ['process' => false, 'message' => 'sin errores', 'data' => []];

        // dd($resultado);
        // try{
        //     $resultados = DB::statement('BEGIN :resultado := EMPLEADO_CRUD_PKG.obtener_detalle_empleado(:p_emp_id); END;', [
        //         'resultado'  => null,
        //         'p_emp_id'  => $emp_id,
        //     ]);

        //     $rto['process'] = true;
        //     $rto['message'] = 'Datos obtenidos';
        //     $rto['data'] = $resultados;
        //     return $rto;

        // }catch (QueryException $e) {
        //     // Captura excepciones específicas relacionadas con la base de datos

        //     // Obtenemos el código de error
        //     $errorCode = $e->getCode();

        //     // Obtenemos el mensaje de error
        //     $errorMessage = $e->getMessage();

        //     if (strpos($errorMessage, 'ORA-20001') !== false) {
        //         $rto['message'] = $errorMessage;
        //         return $rto;
        //     } else {
        //         $rto['message'] = $errorMessage;
        //         return $rto;
        //     }
        // }
    }

    /**
     * Query para interactuar con el paquete "EMPLEADO_CRUD_PKG" y el procedimiento "ActualizarEmpleado"
     * @param Array $datos
     */
    public function updateEmpleado(Array $datos) : Array{
        $rto = ['process' => false, 'message' => 'sin errores'];
        // try{
        //     DB::statement('BEGIN EMPLEADO_CRUD_PKG.ActualizarEmpleado(:p_emp_id, :p_emp_nombre, :p_emp_cargo, :p_emp_salario); END;', [
        //         'p_emp_id'      => $datos['emp_id'],
        //         'p_emp_nombre'  => $datos['nombre'],
        //         'p_emp_cargo'   => $datos['cargo'],
        //         'p_emp_salario' => $datos['salario'],
        //     ]);

        //     $rto['process'] = true;
        //     $rto['message'] = 'Registro actualizado';
        //     return $rto;

        // }catch (QueryException $e) {
        //     // Captura excepciones específicas relacionadas con la base de datos

        //     // Obtenemos el código de error
        //     $errorCode = $e->getCode();

        //     // Obtenemos el mensaje de error
        //     $errorMessage = $e->getMessage();

        //     if (strpos($errorMessage, 'ORA-20001') !== false) {
        //         $rto['message'] = $errorMessage;
        //         return $rto;
        //     } else {
        //         $rto['message'] = $errorMessage;
                return $rto;
        //     }
        // }
    }

}
