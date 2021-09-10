<?php
namespace App\Helpers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Http\Resources\Entry as EntryResource;
use App\Entry;
use Validator;


class Str 
{
    public static function uniqueAlphaNumericEntryString() 
    { 
        $str_result = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ'; 
        $random_string =  substr(str_shuffle($str_result), 0, 10); 

        $ticketnumberValuesCount = Entry::count();
        for ($i=0; $i<$ticketnumberValuesCount; $i++) {
            if (Entry::where("ticketnumber", $random_string) == $random_string) {
                $random_string =  substr(str_shuffle($str_result), 0, 10); 
                $i = 0;
            }             
        }
        return $random_string;
    } 
}
