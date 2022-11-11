<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Material;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;

class MaterialController extends Controller
{
    //to insert into material table
    public function createMaterial(Request $request)
    {
        $data = $request->validate([
            'title' => 'required|string',
            'description' => 'required|string',
            'content' => 'required|string',
            'image' => 'required'
        ]);

        $material = Material::create([
            'title' => $data['title'],
            'description' => $data['description'],
            'image_url' => $this->saveImage($data['image']),
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
    public function deleteMaterial(Request $request)
    {
        $material_id = $request->input('id');

        $material = Material::destroy($material_id);

        return response([
            'success' => true,
            'res' => $material
        ]);
    }
    public function updateMaterial(Request $request)
    {

        $material_id = $request->input('id');
        $file_changed = $request->input('file_changed');

        $data = $request->validate([
            'title' => 'required|string',
            'description' => 'required|string',
            'content' => 'required|string',
        ]);

        if ($file_changed) {

            $material = Material::where('id', $material_id)
            ->update([
                'title' => $data['title'],
                'description' => $data['description'],
                'image_url' => $this->saveImage($request->input('image')),
                'content' => $data['content'],
            ]);
        } else {

            $material = Material::where('id', $material_id)
            ->update([
                'title' => $data['title'],
                'description' => $data['description'],
                'content' => $data['content'],
            ]);
        }
        



        return response([
            'success' => true,
            'res' => $material
        ]);
    }

    private function saveImage($image)
    {

        // Check if image is valid base64 string
        if (preg_match('/^data:image\/(\w+);base64,/', $image, $type)) {
            // Take out the base64 encoded text without mime type
            $image = substr($image, strpos($image, ',') + 1);
            // Get file extension
            $type = strtolower($type[1]); // jpg, png, gif

            // Check if file is an image
            if (!in_array($type, ['jpg', 'jpeg', 'gif', 'png'])) {
                throw new \Exception('invalid image type');
            }
            $image = str_replace(' ', '+', $image);
            $image = base64_decode($image);

            if ($image === false) {
                throw new \Exception('base64_decode failed');
            }
        } else {
            throw new \Exception('did not match data URI with image data');
        }

        $dir = 'images/';
        $file = Str::random() . '.' . $type;
        $absolutePath = public_path($dir);
        $relativePath = $dir . $file;
        if (!File::exists($absolutePath)) {
            File::makeDirectory($absolutePath, 0755, true);
        }
        file_put_contents($relativePath, $image);

        return $relativePath;
    }
}
