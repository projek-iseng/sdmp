<?php

namespace App\Http\Controllers\masterData;

use App\User;
use Carbon\Carbon;
use App\Helpers\id_custom;
use App\Models\PegawaiModel;
use Illuminate\Http\Request;
use App\Models\masterData\Users;
use App\Helpers\enkripsi_helpers;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Http;

class RegistrasiUsers extends Controller
{
    public function store(Request $request)
    {
        $users = [];
    
        DB::beginTransaction();
        try {
            foreach ($request['users'] as $userData) {
                // Enkripsi password
                $encryptedPassword = enkripsi_helpers::customEncryptPassword($userData['namaPegawai'], $userData['passwordPegawai']);
    
                // Generate ID pengguna
                $id = id_custom::P_id($userData['departemenPegawai'], $userData['jabatanPegawai']);
    
                // Simpan ke tabel users
                $user = new Users();
                $user->nousers = $id;
                $user->email = $userData['emailPegawai'];
                $user->name = $userData['usernamePegawai'];
                $user->password = $encryptedPassword;
                $user->save();
    
                // Simpan ke tabel pegawai
                $pegawai = new PegawaiModel();
                $pegawai->namaPegawai = $userData['namaPegawai'];
                $pegawai->objectusersfk = $user->nousers;
                $pegawai->email = $userData['emailPegawai'];
                $pegawai->tglGabung = now()->format('Y-m-d');
                $pegawai->statusenable = true;
                $pegawai->jabatan_id = $userData['jabatanPegawai'];
                $pegawai->departemen_id = $userData['departemenPegawai'];
                $pegawai->save();
    
                $users[] = $user;
            }
    
            DB::commit();
    
            return response()->json([
                'message' => count($users) . ' Users registered successfully',
                'users' => $users,
            ], 201);
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Error saat registrasi batch: ', ['error' => $e->getMessage()]);
    
            return response()->json([
                'message' => 'Gagal melakukan registrasi batch',
                'error' => $e->getMessage(),
            ], 500);
        }
    }

}
