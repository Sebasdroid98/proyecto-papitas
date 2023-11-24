<?php

namespace App\Custom\Queries;

use App\Models\Empleado as ModelsEmpleado;
use Illuminate\Support\Facades\DB;

class Empleado
{

    /**
     * Query para consultar todos los registros de la tabla empleado
     */
    public function getListaEmpleados() {
        // return ModelsEmpleado::all();
        return DB::select("SELECT * FROM EMPLEADOS");
    }

}