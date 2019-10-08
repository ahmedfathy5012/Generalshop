<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use app\Unit;

class DataImportController extends Controller
{
    public function importUnits(){
        $units = [
            "AS" => "Assortment",
            "BG" => "Bag",
            "BA" => "Bale"
        ];

        foreach($units as $key => $value){
           DB::table('units')->insert([
               'unit_code' => $key ,
               'unit_name' => $value,
               'created_at' => now(),
               'updated_at' => now()
           ]);
        }


       /* foreach($units as $key => $value){
           $unit = new Unit();
           $unit->unit_code=$key;
           $unit->unit_name=$value;
           $unit->save();
         }*/
    }
}
