<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use App\Medicine;
use DB;

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

    public function add(Request $request)
    {
        // het veld Wanneer kan de waardes hebben: 
        // Iedere dag (7d), om de dag (4d), 1 keer per week (1w)
        $veldenUitRequest = array(
            'naam' => $request->input('naam'),
            'dosering' => $request->input('dosering'),
            'wanneer' => $request->input('wanneer'),
            'datum_van' => $request->input('datum_van'),
            'datum_tot' => $request->input('datum_tot'),
            'tijd' => $request->input('tijd'),
        );

        json_encode($veldenUitRequest);

        $validator = Validator::make($veldenUitRequest, [
            'naam' => 'required|string|max:255',
            'dosering' => 'required|string|max:255',
            'wanneer' => 'required|string|max:255',
            'datum_van' => 'required|date|max:255',
            'datum_tot' => 'required|date|max:255',
            'tijd' => 'required|max:255',
        ]);

        if($validator->fails()){
            return response()->json($validator->errors()->toJson(), 400);
        }

        // creeër logopedist en sla op in database
        $medicine = Medicine::create($veldenUitRequest);

        return response()->json(compact('medicine'), 201);

        $medicine->save();
    }
}
