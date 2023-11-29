<?php

namespace App\Custom\Queries;

use App\Models\User;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\DB;

class Usuarios
{

    /**
     * Query para interactuar con el paquete "TAREAS_CRUD_PKG" y el procedimiento "CrearTarea"
     * @param Array $datos
     */
    public function createUser(Array $datos) : Array{
        $rto = ['process' => false, 'message' => 'sin errores'];
        User::create([
            'name' => $datos['nombre'],
            'email' => $datos['email'],
            'password' => bcrypt($datos['password']),
            'rol' => $datos['cargo'],
        ]);
        $rto['process'] = true;
        return $rto;
    }

}
