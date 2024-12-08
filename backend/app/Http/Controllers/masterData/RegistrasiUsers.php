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
                $encryptedPassword = enkripsi_helpers::customEncryptPassword($userData['namaPegawai'], $userData['passwordPegawai']);
                $id = id_custom::P_id($userData['departemenPegawai'], $userData['jabatanPegawai']);
    
                $user = new Users();
                $user->nousers = $id;
                $user->email = $userData['emailPegawai'];
                $user->name = $userData['usernamePegawai'];
                $user->password = $encryptedPassword;
                $user->statusenable = true;
                $user->save();
    
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

    public function index(Request $request)
    {
        $pegawai = DB::table('pegawai_M as pg')
            ->select('pg.*', 'dpm.namaDepartemen', 'jb.namaJabatan')
            ->join('jabatan_M as jb', 'jb.id', '=', 'pg.jabatan_id')
            ->join('departemen_M as dpm', 'dpm.id', '=', 'pg.departemen_id')
            ->where('pg.statusenable', true);
        if ($request->has('namaPegawai')) {
            $pegawai->where('pg.namaPegawai', 'like', '%' . $request->namaPegawai . '%');
        }
        if ($request->has('idPegawai')) {
            $pegawai->where('pg.objectusersfk', $request->idPegawai);
        }
        if ($request->has('jabatan')) {
            $pegawai->where('jb.namaJabatan', 'like', '%' . $request->jabatan . '%');
        }
        if ($request->has('departemen')) {
            $pegawai->where('dpm.namaDepartemen', 'like', '%' . $request->departemen . '%');
        }
        $result = $pegawai->get()->map(function ($item) {
            $item->foto = $item->foto ? asset($item->foto) : null;
            return $item;
        });

        return response()->json($result);
    }

}
