<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Material;

class MaterialController extends Controller
{
    //to insert into material table
    public function createMaterial(Request $request)
    {
        $data = $request->validate([
            'image_url' => 'required|string',
            'description' => 'required|string',
        ]);

        $material = Material::create([
            'name' => $data['image_url'],
            'description' => $data['description'],
        ]);

        return response([
            'material' => $material
        ]);
    }

    public function getMaterial()
    {
        $materials = Material::all();

        return response([
            'material' => $materials
        ]);
    }
}
