<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class MedicineController extends Controller
{
    public function index(Request $request)
    {
        $allMedicijnen = DB::table('medicines')->get();

        return response()->json([$allMedicijnen]);
    }

    public function get($id)
    {
        $medicijn = DB::table('medicines')
                    ->where('id', $id)
                    ->first();

        if(isset($medicijn)) {
            return response()->json(['medicijn' => $medicijn], 200);
        } else {
            return response()->json('medicijn is niet gevonden voor meegegeven ID', 400);
        }
    }

}
