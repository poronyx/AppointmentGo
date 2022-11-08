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
            'title' => 'required|string',
            'description' => 'required|string',
            'image_url' => 'required|string',
            'content' => 'required|string',
        ]);

        $material = Material::create([
            'title' => $data['title'],
            'description' => $data['description'],
            'image_url' => $data['image_url'],
            'content' => $data['content'],
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
