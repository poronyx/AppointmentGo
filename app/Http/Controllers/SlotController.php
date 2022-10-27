<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Slot;
use Illuminate\Http\Request;

class SlotController extends Controller
{
    //
    public function createSlotsInstitute(Request $request)
    {
        //First slot from and to
       
        //Second slot from and to
        $mytime = Carbon::now();
        //Generate slots for the next 90 days
        for($i = 1;$i<=90;$i++)
        {
            $slot = Slot::create([
                'owner_id' =>  $request->input('owner_id'),
                'slot_date' => $mytime->addDay()->toDateString(),
                'time_slot' => $request->input('time_slot')
            ]);

        }


        return response([
            'res' => 'Success!',
            'time' => $mytime,
        ]);
    }
}
