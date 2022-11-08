<?php

namespace App\Http\Controllers;

use App\Models\Instituition;
use App\Models\Slot;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class InstituitionController extends Controller
{
    //to insert into institution table
    public function createInstituition(Request $request)
    {
        $data = $request->validate([
            'instituition_type' => 'required|string',
            'instituition_name' => 'required|string',
            'instituition_addr' => 'required|string',
            'instituition_phone' => 'required|string',
            'instituition_desc' => 'required|string',
            'location.lat' => 'required|string',
            'location.lng' => 'required|string',
            'opening_time.first' => 'required',
            'opening_time.second' => 'required',
            'organization_id' => 'required'
        ]);

        $institute = Instituition::create([
            'instituition_type' => $data['instituition_type'],
            'instituition_name' => $data['instituition_name'],
            'instituition_addr' => $data['instituition_addr'],
            'instituition_phone' => $data['instituition_phone'],
            'instituition_desc' => $data['instituition_desc'],
            'location' => $request->input('location'),
            'opening_time' => $request->input('opening_time'),
            'organization_id' => $data['organization_id'],
        ]);

        //Create Slots data for institute according to opening time
        //Generate three months ahead from today

        return response([
            'institute' => $institute
        ]);
    }

    public function getInstituition()
    {
        $institutes = Instituition::all();

        return response([
            'institutes' => $institutes
        ]);
    }
    public function deleteInstitute(Request $request)
    {

        $institute_id = $request->input('id');

        $institute = Instituition::destroy($institute_id);
        //delete slots that belongs to this institute
        $mytime = Carbon::now()->addDay();
        //Delete All slots affiliated with this institute
        //Date before today's data will be kept
        for ($i = 1; $i <= 91; $i++) {

            $day = $mytime->addDay()->toDateString();
            $whereArray = array('owner_id' => $institute_id, 'slot_date' => $day);

            $query = DB::table('slots');
            foreach ($whereArray as $field => $value) {
                $query->where($field, $value);
            }
            $query->delete();
        }


        return response([
            'success' => true,
            'res' => $institute
        ]);
    }

    public function updateInstitute(Request $request)
    {

        $institute_id = $request->input('id');
        $timeChanged =  $request->input('timeChanged');

        $data = $request->validate([
            'instituition_type' => 'required|string',
            'instituition_name' => 'required|string',
            'instituition_addr' => 'required|string',
            'instituition_phone' => 'required|string',
            'instituition_desc' => 'required|string',
            'location.lat' => 'required|string',
            'location.lng' => 'required|string',
            'opening_time.first' => 'required',
            'opening_time.second' => 'required',
            'timeChanged' => 'required',
            
        ]);

        $institute = Instituition::where('id', $institute_id)
            ->update([
                'instituition_type' => $data['instituition_type'],
                'instituition_name' => $data['instituition_name'],
                'instituition_addr' => $data['instituition_addr'],
                'instituition_phone' => $data['instituition_phone'],
                'instituition_desc' => $data['instituition_desc'],
                'location' => $request->input('location'),
                'opening_time' => $request->input('opening_time'),
                
            ]);

        //If the opening time was changed
        if ($timeChanged) {

            //delete slots that belongs to this institute
            $mytime = Carbon::now()->addDay();
            //Delete All slots affiliated with this institute
            //Date before today's data will be kept
            for ($i = 1; $i <= 91; $i++) {

                $day = $mytime->addDay()->toDateString();
                $whereArray = array('owner_id' => $institute_id, 'slot_date' => $day);

                $query = DB::table('slots');
                foreach ($whereArray as $field => $value) {
                    $query->where($field, $value);
                }
                $query->delete();
            }

            $newtime = Carbon::now();
            //Replace the deleted slots with new time slots
            $firstOpeningTime = $request->input("opening_time.first");
            $secondOpeningTime = $request->input("opening_time.second");

            $ownerType = "Institute";

            for ($i = 1; $i <= 90; $i++) {

                $day = $newtime->addDay()->toDateString();
                for ($x = $firstOpeningTime[0]; $x <= $firstOpeningTime[1]; $x++) {
                    $slot = Slot::create([
                        'owner_id' =>  $institute_id,
                        'slot_date' => $day,
                        'time_slot' => $x,
                        'owner_type' => $ownerType
                    ]);
                }
                for ($y = $secondOpeningTime[0]; $y <= $secondOpeningTime[1]; $y++) {
                    $slot = Slot::create([
                        'owner_id' =>  $institute_id,
                        'slot_date' => $day,
                        'time_slot' => $y,
                        'owner_type' => $ownerType
                    ]);
                }
            }
        }

        return response([
            'success' => true,
            'res' => $institute
        ]);
    }
}
