<?php

namespace App\Http\Controllers;

use App\Reminder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ReminderController extends Controller
{
    public function add(Request $request)
    {
        // het veld Wanneer kan de waardes hebben:
        // Iedere dag (7d), om de dag (4d), 1 keer per week (1w)
        $veldenUitRequest = array(
            'id' => $request->input('id'),
            'naam' => $request->input('naam'),
            'dosering' => $request->input('dosering'),
            'wanneer' => $request->input('wanneer'),
            'datum_van' => $request->input('datum_van'),
            'datum_tot' => $request->input('datum_tot'),
            'tijd' => $request->input('tijd'),
        );

        json_encode($veldenUitRequest);

        $validator = Validator::make($veldenUitRequest, [
            'id' => 'required|max:255',
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

        $datum_van = $veldenUitRequest['datum_van'];
        $datum_tot = $veldenUitRequest['datum_tot'];

        // function to get date_range
        function date_range($first, $last, $step = '+1 day', $output_format = 'Y/m/d' ) {

            $dates = array();
            $current = strtotime($first);
            $last = strtotime($last);

            while( $current <= $last ) {

                $dates[] = date($output_format, $current);
                $current = strtotime($step, $current);
            }

            return $dates;
        }

        $dates = date_range($datum_van, $datum_tot);


        // dit alleen doen als 'wanneer' veld 7d is, dus als de reminder voor iedere dag is
        if($veldenUitRequest['wanneer'] == '7d'){
            // loop through dates array and create reminder in reminders table
            foreach($dates as $date){

                // creeër logopedist en sla op in database
                $reminder = Reminder::create([
                    'medicine_id' => $veldenUitRequest['id'],
                    'datum' => $date,
                    'tijd' => $veldenUitRequest['tijd']
                ]);

                $reminder->save();
            }
            // voer dit uit als 'wanneer' de waarde 1w heeft dus als het maar 1 keer per week moet
        } elseif($veldenUitRequest['wanneer'] == '1w'){

            $firstDateOfWeek = date("w", strtotime($dates[0]));

            foreach($dates as $date){

                $dayOfWeek = date("w", strtotime($date));

                if($firstDateOfWeek === $dayOfWeek){
                    $reminder = Reminder::create([
                        'medicine_id' => $veldenUitRequest['id'],
                        'datum' => $date,
                        'tijd' => $veldenUitRequest['tijd']
                    ]);

                    $reminder->save();
                }

            }

        }

    }

}
