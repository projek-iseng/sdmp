<?php

namespace App\Helpers;

class enkripsi_helpers
{
    public static function customEncryptPassword($plaintext)
    {
        $random_start = rand(10, 99);  // Contoh: angka acak antara 10 dan 99
        $random_middle = rand(10, 99); // Contoh: angka acak antara 10 dan 99
        $random_end = rand(1000, 9999);
        $first_letter = strtolower($plaintext[0]); // Ambil huruf depan password
        $prefix_start = $first_letter . $random_start;    // Contoh: r12
        $prefix_middle = $first_letter . $random_middle;   // Contoh: r05
        $prefix_end = $first_letter . $random_end;    // Contoh: r2004

        // Algoritma AES untuk enkripsi
        $key = env('ENCRYPTION_KEY', 'kunci-unik-anda'); // Ambil dari .env atau default
        $method = 'AES-256-CBC';
        $iv = openssl_random_pseudo_bytes(16); // IV acak
        $ciphertext = openssl_encrypt($plaintext, $method, $key, OPENSSL_RAW_DATA, $iv);

        // Gabungkan hasil enkripsi
        $encoded_ciphertext = base64_encode($iv . $ciphertext);
        return $prefix_start . $encoded_ciphertext . $prefix_middle . $prefix_end;
    }
}
