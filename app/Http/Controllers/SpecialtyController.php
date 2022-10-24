<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Specialty;
class SpecialtyController extends Controller
{
    //to insert into Specialty table
    public function createSpecialty(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string|unique:specialties,name',
            'description' => 'required|string',
        ]);

        $specialty = Specialty::create([
            'name' => $data['name'],
            'description' => $data['description'],
        ]);

        return response([
            'specialty' => $specialty
        ]);
    }

    public function getSpecialty()
    {
        $specialty = Specialty::all();

        return response([
            'specialties' => $specialty
        ]);
    }
}
