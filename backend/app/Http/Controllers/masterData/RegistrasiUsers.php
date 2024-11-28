<?php

namespace App\Http\Controllers\masterData;

use App\Helpers\enkripsi_helpers;
use App\Http\Controllers\Controller;
use App\Models\masterData\Users;
use App\Models\PegawaiModel;
use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class RegistrasiUsers extends Controller
{
    public function store(Request $request)
{
    $validated = $request->validate([
        'namaPegawai' => 'required|string|max:255',
        'emailPegawai' => 'required|email|unique:users,email',
        'usernamePegawai' => 'required|string|max:255|unique:users,username',
    ]);

    $encryptedPassword = enkripsi_helpers::customEncryptPassword($request->usernamePegawai);

    $registrasi = new Users();
    $registrasi->name = $validated['namaPegawai'];
    $registrasi->email = $validated['emailPegawai'];
    $registrasi->username = $validated['usernamePegawai'];
    $registrasi->password = $encryptedPassword;
    $registrasi->save();

    $pegawai = new PegawaiModel();
    $pegawai->namaPegawai   = $request->namaPegawai;
    $pegawai->email         = $request->emailPGW;
    $pegawai->noTelepon     = $request->noTeleponPGW;
    $pegawai->alamat        = $request->alamatPGW;
    $pegawai->tglGabung     = Carbon::now();
    $pegawai->jabatan_id    = $request->jabatanPGW;
    $pegawai->statusenable  = true;
    $pegawai->departemen_id = $request->departemenPGW;
    $pegawai->save();

    return response()->json([
        'message' => 'User registered successfully',
        'user' => $registrasi,
    ]);
}
}
