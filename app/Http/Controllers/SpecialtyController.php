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

    public function deleteSpecialty(Request $request)
    {

        $specialty_id = $request->input('id');

        $specialty = Specialty::destroy($specialty_id);

        return response([
            'success' => true,
            'res' => $specialty
        ]);
    }

    public function updateSpecialty(Request $request)
    {
        $specialty_id = $request->input('id');

        $specialty = Specialty::where('id', $specialty_id)
            ->update([
                'name' => $request->input('name'),
                'description' => $request->input('description'),
            ]);

            return response([
                'specialty' => $specialty
            ]);
    }
}
