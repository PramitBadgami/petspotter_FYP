<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\PetCategory;
use App\Models\Pet;
use Illuminate\Support\Facades\Validator;
use App\Models\TempPetImage;
use App\Models\Breed;
use Illuminate\Support\Facades\File;
use App\Models\PetImage;
use Illuminate\Http\Request;
use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver;

class PetController extends Controller
{
    public function index(Request $request) {
        $pets = Pet::latest('id')->with('pet_images');

        if($request->get('keyword') != "") {
            $pets = $pets->where('name','like','%'.$request->keyword.'%');
        }

        $pets = $pets->paginate();
        $data['pets'] = $pets;
        return view('admin.pets.list', $data);
    }

    public function create() {
        $data = [];
        $petCategories = PetCategory::orderBy('name','ASC')->get();
        $breeds = Breed::orderBy('breed','ASC')->get();
        $data['petCategories'] = $petCategories;
        $data['breeds'] = $breeds;
        return view('admin.pets.create', $data);
    }

    public function store(Request $request){

        $rules = [
            'name' => 'required',
            'slug' => 'required|unique:pets',
            'age' => 'required|numeric',
            'gender' => 'required|in:Male,Female',
            'category' => 'required|numeric',
            'is_featured' => 'required|in:Yes,No',
        ];

        $validator = Validator::make($request->all(),$rules);

        if ($validator->passes()) {
        
            // dd($request->img_array);
            // exit();
            $pet = new Pet;
            $pet->name = $request->name;
            $pet->slug = $request->slug;
            $pet->description = $request->description;
            $pet->age = $request->age;
            $pet->gender = $request->gender;
            $pet->status = $request->status;
            $pet->category_id = $request->category;
            $pet->breed_id = $request->breed;
            $pet->is_featured = $request->is_featured;
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
