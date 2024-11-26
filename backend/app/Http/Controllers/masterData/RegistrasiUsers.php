<?php

namespace App\Http\Controllers\masterData;

use App\Http\Controllers\Controller;
use App\Models\masterData\Users;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class RegistrasiUsers extends Controller
{
    public function register(Request $request)
    {
        // masih belum bisa 
        $email = $request->input('email');
        $googleApiKey = env('GOOGLE_API_KEY');
        $response = Http::get("https://people.googleapis.com/v1/people:searchContacts", [
            'query' => $email,
            'key' => $googleApiKey,
        ]);
        if ($response->failed() || empty($response->json('results'))) {
            return response()->json(['message' => 'Email tidak terdaftar di Google'], 400);
        }
        $googleToken = $response->json('results.0.token');
        $user = Users::create([
            'name' => $request->input('username'),
            'email' => $email,
            'password' => bcrypt($request->input('password')),
            'remember_token' => $googleToken,
        ]);

        return response()->json(['message' => 'Registrasi berhasil', 'user' => $user], 201);
    }
}
