<?php

namespace App\Http\Controllers;

use App\Models\GajiModel;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class GajiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $gaji = GajiModel::all();
        $data = [
            "gaji" => $gaji,
            "message" => 'success'
        ];
        return response()->json([
            'success' => true,
            'data' => $data
        ], Response::HTTP_OK);
    }


    public function store(Request $request) {}

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
