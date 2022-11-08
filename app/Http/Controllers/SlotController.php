<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Slot;
use Illuminate\Http\Request;

class SlotController extends Controller
{
    //
    public function createSlots(Request $request)
    {

        //Second slot from and to
        $mytime = Carbon::now();
        //Get First Opening time
        $firstOpeningTime = $request->input("opening_time.first");
        $secondOpeningTime = $request->input("opening_time.second");

        //Define Slot owner's type
        $ownerType = $request->input('owner_type');


        //Generate slots for the next 90 days
        for ($i = 1; $i <= 90; $i++) {

            $day = $mytime->addDay()->toDateString();
            for ($x = $firstOpeningTime[0]; $x <= $firstOpeningTime[1]; $x++) {
                $slot = Slot::create([
                    'owner_id' =>  $request->input('owner_id'),
                    'slot_date' => $day,
                    'time_slot' => $x,
                    'owner_type' => $request->input('owner_type')
                ]);
            }
            for ($y = $secondOpeningTime[0]; $y <= $secondOpeningTime[1]; $y++) {
                $slot = Slot::create([
                    'owner_id' =>  $request->input('owner_id'),
                    'slot_date' => $day,
                    'time_slot' => $y,
                    'owner_type' => $request->input('owner_type')
                ]);
            }
        }




        return response([
            'res' => 'Success!',
            'time' => $ownerType == 'Institute',

        ]);
    }
}
