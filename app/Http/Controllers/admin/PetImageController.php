<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\PetImage;
use Illuminate\Http\Request;
use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver;
use Illuminate\Support\Facades\File;

class PetImageController extends Controller
{
    public function update(Request $request) {

        $image = $request->image;
        $ext = $image->getClientOriginalExtension();
        $sourcePath = $image->getPathName();

        //DB store
        $petImage = new PetImage();
        $petImage->pet_id = $request->pet_id;
        $petImage->image = 'NULL';
        $petImage->save();

        //Update in the DB
        $imageName = $request->pet_id.'-'.$petImage->id.'-'.time().'.'.$ext;
        // product_id = 4; $product_image_id =1
        // 4-1-12231.jpg/png
        $petImage->image=$imageName;
        $petImage->save();

        //Generating Thumbnail
        // Large Image
        $destPath = public_path().'/uploads/pet/large/'.$imageName;
        $manager = new ImageManager(Driver::class);
        $image = $manager->read($sourcePath);
        $image->scale(1400,1200);
        $image->save($destPath);

        //Small Image
        $destPath = public_path().'/uploads/pet/small/'.$imageName;
        $manager = new ImageManager(Driver::class);
        $image = $manager->read($sourcePath);
        $image->scale(300,300);
        $image->save($destPath);

        return response()->json([
            'status' => true,
            'image_id' => $petImage->id,
            'ImagePath' => asset('uploads/pet/small/'.$petImage->image),
            'message' => 'Image saved successfully'
        ]);
    }


    public function destroy(Request $request) {
        $petImage = PetImage::find($request->id);

        if(empty($petImage)) {
            return response()->json([
                'status' => false,
                'message' => 'Image not found'
            ]);
        }

        // Delete images from folder
        File::delete(public_path('uploads/pet/large/'.$petImage->image));
        File::delete(public_path('uploads/pet/small/'.$petImage->image));

        // Delete image from DB
        $petImage->delete();

        return response()->json([
            'status' => true,
            'message' => 'Image deleted successfully'
        ]);
    }
}
