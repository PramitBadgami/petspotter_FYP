<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\TempPetImage;
use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver;

class TempPetImagesController extends Controller
{
    public function create(Request $request) {
        $image = $request->image;

        if (!empty($image)) {
            $ext = $image->getClientOriginalExtension();
            $newName = time().'.'.$ext;

            $tempImage = new TempPetImage();
            $tempImage->name = $newName;
            $tempImage->save();

            $image->move(public_path().'/temp/',$newName);

            // Generate thumbnail
            $sourcePath = public_path().'/temp/'.$newName;
            $destPath = public_path().'/temp/thumb/'.$newName;
            $manager = new ImageManager(Driver::class);
            $image = $manager->read($sourcePath);
            $image->scale(300,275);
            $image->save($destPath);

            return response()->json([
                'status' => true,
                'image_id' => $tempImage->id,
                'ImagePath' => asset('/temp/thumb/'.$newName),
                'message' => 'image uploaded successfully'
            ]);
        }
    }
}
