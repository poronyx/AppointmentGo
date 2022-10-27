<?php

namespace App\Http\Controllers;

use App\Models\Instituition;
use Illuminate\Http\Request;

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
        ]);

        $institute = Instituition::create([
            'instituition_type' => $data['instituition_type'],
            'instituition_name' => $data['instituition_name'],
            'instituition_addr' => $data['instituition_addr'],
            'instituition_phone' => $data['instituition_phone'],
            'instituition_desc' => $data['instituition_desc'],
            'location' => $request->input('location'),
            'opening_time' => $request->input('opening_time'),
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
}
