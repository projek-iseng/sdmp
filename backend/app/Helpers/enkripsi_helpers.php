<?php

namespace App\Helpers;

class enkripsi_helpers
{
    public static function customEncryptPassword($plaintext,$password)
    {
        $random_start = rand(1000, 9999); 
        $random_middle = rand(1000, 9999);
        $random_end = rand(1000, 9999);
        $first_letter = strtolower($plaintext[0]); 
        $prefix_start = $first_letter . $random_start;    
        $prefix_middle = $first_letter . $random_middle;  
        $prefix_end = $first_letter . $random_end;    
        $hashed_password = md5($password);
        $final_password = $prefix_start . $hashed_password . $prefix_middle . $prefix_end;
        return $final_password;
    }

}
