<?php

namespace App\Http\Controllers\master;

use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;

use App\Models\ModelGaji;
use App\Http\Controllers\Controller;

class GajiController extends Controller
{
    public function index()
    {

        if (!Auth::check()) {
            return response()->json(['message' => 'You must be logged in'], Response::HTTP_UNAUTHORIZED);
        }

        $gaji = ModelGaji::all();
        $data = [
            "Gaji" => $gaji,
            "message" => 'success'
        ];


        return response()->json([
            'success' => true,
            'data' => $data
        ], Response::HTTP_OK);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        if (!Auth::check()) {
            return response()->json(['message' => 'You must be logged in'], Response::HTTP_UNAUTHORIZED);
        }

        // Ambil data pengguna yang login
        $user = Auth::user();

        $validated = $request->validate([

            'is_active' => 'boolean',
            'nominal' => 'integer',
            'kd_gaji' => 'required',



        ]);

        // Menambahkan UUID dan informasi pengguna yang membuat atau memperbarui Gaji
        $gaji = ModelGaji::create([
            'uuid' => (string) Str::uuid(), // Membuat UUID baru untuk Gaji
            'is_active' => $validated['is_active'] ?? true, // Jika tidak ada nilai, default ke true
            'nominal' => $validated['nominal'],
            'kd_gaji' => $validated['kd_gaji'],
            'created_by' => $user->uuid, // UUID pengguna yang sedang login
            'updated_by' => $user->uuid, // UUID pengguna yang sedang login
        ]);
        return response()->json([
            'success' => true,
            'data' => $gaji
        ], Response::HTTP_CREATED);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        if (!Auth::check()) {
            return response()->json(['message' => 'You must be logged in'], Response::HTTP_UNAUTHORIZED);
        }

        $gaji = ModelGaji::find($id);

        if (!$gaji) {
            return response()->json(['message' => 'Data not found'], Response::HTTP_NOT_FOUND);
        }

        return response()->json([
            'success' => true,
            'data' => $gaji
        ], Response::HTTP_OK);
    }

    public function edit(string $id)
    {
        if (!Auth::check()) {
            return response()->json(['message' => 'You must be logged in'], Response::HTTP_UNAUTHORIZED);
        }

        $gaji = ModelGaji::find($id);

        if (!$gaji) {
            return response()->json(['message' => 'Data not found'], Response::HTTP_NOT_FOUND);
        }

        return response()->json([
            'success' => true,
            'data' => $gaji
        ], Response::HTTP_OK);
    }

    public function update(Request $request, string $id)
    {
        if (!Auth::check()) {
            return response()->json(['message' => 'You must be logged in'], Response::HTTP_UNAUTHORIZED);
        }

        $gaji = ModelGaji::find($id);

        if (!$gaji) {
            return response()->json(['message' => 'Data not found'], Response::HTTP_NOT_FOUND);
        }

        $validated = $request->validate([
            'is_active' => 'boolean',
            'nama' => 'required|string|max:12',
        ]);

        $gaji->update([
            'is_active' => $validated['is_active'] ?? $gaji->is_active,
            'nama' => $validated['nama'],
            'updated_by' => Auth::user()->id,
        ]);

        return response()->json([
            'success' => true,
            'data' => $gaji
        ], Response::HTTP_OK);
    }

    public function destroy(string $id)
    {
        if (!Auth::check()) {
            return response()->json(['message' => 'You must be logged in'], Response::HTTP_UNAUTHORIZED);
        }

        $gaji = ModelGaji::find($id);

        if (!$gaji) {
            return response()->json(['message' => 'Data not found'], Response::HTTP_NOT_FOUND);
        }

        $gaji->delete();

        return response()->json([
            'success' => true,
            'message' => 'Data deleted successfully'
        ], Response::HTTP_OK);
    }

    public function disable(string $id)
    {
        $gaji = ModelGaji::find($id);
        if (!$gaji) {
            return response()->json([
                'success' => false,
                'message' => 'Data yang dicari tidak ada',
            ], Response::HTTP_NOT_FOUND);
        }
        //update is aktive menjadi false
        $gaji->is_active = false;

        //simpan perubahan ke database
        $gaji->save();

        //kembalikan response sukses
        return response()->json([
            'success' => true,
            'message' => 'Data berhasil dinonaktifkan',
            'data' => $gaji,
        ], Response::HTTP_OK);
    }
}
