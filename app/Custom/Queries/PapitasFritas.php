<?php

namespace App\Custom\Queries;

use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\DB;

class PapitasFritas
{
    /**
     * Query para consultar todos los registros de la tabla clientes
     */
    public function getListaPapitas() {
        return DB::select("SELECT * FROM PAPITASFRITAS ORDER BY PAPITAFRITA_ID DESC");
    }

}
