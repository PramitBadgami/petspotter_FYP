<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PetCategory;
use App\Models\Pet;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use App\Models\TempPetImage;
use App\Models\Breed;
use Illuminate\Support\Facades\File;
use App\Models\PetImage;
use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver;

class AddController extends Controller
{
    public function create() {

        if (Auth::check()==false) {
            return redirect()->route('account.login');
        }

        $data = [];
        $petCategories = PetCategory::orderBy('name','ASC')->get();
        $breeds = Breed::orderBy('breed','ASC')->get();
        $data['petCategories'] = $petCategories;
        $data['breeds'] = $breeds;
        return view('frontend.create', $data);
    }

    public function store(Request $request){

        $rules = [
            'name' => 'required',
            'slug' => 'required|unique:pets',
            'age' => 'required|numeric',
            'gender' => 'required|in:Male,Female',
            'category' => 'required|numeric',
        ];

        $validator = Validator::make($request->all(),$rules);

        if ($validator->passes()) {
        
            // dd($request->img_array);
            // exit();

            $user = Auth::user();

            $pet = new Pet;
            $pet->user_id = $user->id;
            $pet->name = $request->name;
            $pet->slug = $request->slug;
            $pet->description = $request->description;
            $pet->age = $request->age;
            $pet->gender = $request->gender;
            $pet->status = 0;
            $pet->category_id = $request->category;
            $pet->breed_id = $request->breed;
            $pet->short_description = $request->short_description;
            $pet->save();

            //Save Gallery Pictures
            if(!empty($request->img_array)) {
                foreach ($request->img_array as $temp_image_id) {

                    $tempImageInfo = TempPetImage::find($temp_image_id);
                    $extArray = explode('.',$tempImageInfo->name);
                    $ext = last($extArray); //like jpg,gif,png etc

                    //DB store
                    $petImage = new PetImage();
                    $petImage->pet_id = $pet->id;
                    $petImage->image = 'NULL';
                    $petImage->save();

                    $imageName = $pet->id.'-'.$petImage->id.'-'.time().'.'.$ext;
                    // product_id = 4; $product_image_id =1
                    // 4-1-12231.jpg/png
                    $petImage->image=$imageName;
                    $petImage->save();

                    // Generate Product Thumbnails

                    // Large Image
                    $sourcePath = public_path().'/temp/'.$tempImageInfo->name;
                    $destPath = public_path().'/uploads/pet/large/'.$imageName;
                    $manager = new ImageManager(Driver::class);
                    $image = $manager->read($sourcePath);
                    $image->scale(1400, 1200);
                    $image->save($destPath);

                    //Small Image
                    $destPath = public_path().'/uploads/pet/small/'.$imageName;
                    $manager = new ImageManager(Driver::class);
                    $image = $manager->read($sourcePath);
                    $image->scale(300,300);
                    $image->save($destPath);
                }
            }

            $request->session()->flash('success', 'Pet added successfully');

            return response()->json([
                'status' => true,
                'message' => 'Pet added successfully'
            ]);

        } else {
            return response()->json([
                'status' => false,
                'errors' => $validator->errors()
            ]);
        }
    
    }
}
