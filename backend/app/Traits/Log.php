<?php

namespace App\Traits;

use App\Models\LoggingUser;
use Illuminate\Support\Facades\Auth;

trait Log
{
    public function LOGGING($jenislog, $uuid, $referensi, $keterangan)
    {
        $logUser = new LoggingUser();
        // tinggal isi apa yang di perlukan
        $logUser->save();
    }
}