<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\ProductImage;
use Illuminate\Http\Request;
use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver;
use Illuminate\Support\Facades\File;

class ProductImageController extends Controller
{
    public function update(Request $request) {

        $image = $request->image;
        $ext = $image->getClientOriginalExtension();
        $sourcePath = $image->getPathName();

        //Inserting in the DB
        $productImage = new ProductImage();
        $productImage->product_id = $request->product_id;
        $productImage->image = 'NULL';
        $productImage->save();

        //Update in the DB
        $imageName = $request->product_id.'-'.$productImage->id.'-'.time().'.'.$ext;
        // product_id = 4; $product_image_id =1
        // 4-1-12231.jpg/png
        $productImage->image=$imageName;
        $productImage->save();

        //Generating Thumbnail
        // Large Image
        $destPath = public_path().'/uploads/product/large/'.$imageName;
        $manager = new ImageManager(Driver::class);
        $image = $manager->read($sourcePath);
        $image->scale(1400,1200);
        $image->save($destPath);

        //Small Image
        $destPath = public_path().'/uploads/product/small/'.$imageName;
        $manager = new ImageManager(Driver::class);
        $image = $manager->read($sourcePath);
        $image->scale(300,300);
        $image->save($destPath);

        return response()->json([
            'status' => true,
            'image_id' => $productImage->id,
            'ImagePath' => asset('uploads/product/small/'.$productImage->image),
            'message' => 'Image saved successfully'
        ]);
    }

    public function destroy(Request $request) {
        $productImage = ProductImage::find($request->id);

        if(empty($productImage)) {
            return response()->json([
                'status' => false,
                'message' => 'Image not found'
            ]);
        }

        // Delete images from folder
        File::delete(public_path('uploads/product/large/'.$productImage->image));
        File::delete(public_path('uploads/product/small/'.$productImage->image));

        // Delete image from DB
        $productImage->delete();

        return response()->json([
            'status' => true,
            'message' => 'Image deleted successfully'
        ]);
    }
}
