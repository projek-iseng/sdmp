<?php

namespace App\Helpers;

use App\Models\DepartemenModel;
use App\Models\JabatanModel;
use App\Models\PegawaiModel;

class id_custom
{
    public static function P_id($idDepartemen, $idJabatan)
    {
        $namaJabatan = JabatanModel::select('id', 'namaJabatan')
                            ->where('id', $idJabatan)
                            ->first();
        $idStart = $idDepartemen;
        $idEnd = $idJabatan;
        $idRandom = rand(1000000000, 9999999999);
        $frestNamajbt = strtoupper($namaJabatan->namaJabatan[0]); 
        $idUsers = $frestNamajbt.'-'.$idStart.'-'.$idEnd.'-'.$idRandom;
        return $idUsers;
    }

}
