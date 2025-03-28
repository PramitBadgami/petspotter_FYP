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
        $pets = Pet::latest('id')->with('pet_images')->with('user');

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
            $pet->short_description = $request->short_description;
            $pet->related_pets = (!empty($request->related_pets)) ? implode(',',$request->related_pets) : '';
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

    public function edit($id, Request $request) {
        
        $pet = Pet::find($id);

        if(empty($pet)) {

            return redirect()->route('pets.index')->with('error','Pet not found');
        }


        // Fetch Product Images
        $petImages = PetImage::where('pet_id',$pet->id)->get();

        $relatedPets = [];
        // fetch related products
        if($pet->related_pets != '') {
            $petArray = explode(',',$pet->related_pets);
            $relatedPets = Pet::whereIn('id',$petArray)->with('pet_images')->get();
        }

        $data = [];
        $data['pet'] = $pet;

        $petCategories = PetCategory::orderBy('name','ASC')->get();
        $breeds = Breed::orderBy('breed','ASC')->get();
        $data['petCategories'] = $petCategories;
        // $data['pet'] = $pet;
        $data['breeds'] = $breeds;
        $data['petImages'] = $petImages;
        $data['relatedPets'] = $relatedPets;
        return view('admin.pets.edit', $data);
    }

    public function update($id, Request $request) {

        $pet = Pet::find($id);

        $rules = [
            'name' => 'required',
            'slug' => 'required|unique:pets,slug,'.$pet->id.',id',
            'age' => 'required|numeric',
            'gender' => 'required|in:Male,Female',
            'category' => 'required|numeric',
            'is_featured' => 'required|in:Yes,No',
        ];

        $validator = Validator::make($request->all(),$rules);

        if ($validator->passes()) {
        
            // dd($request->img_array);
            // exit();
            // $pet = new Pet;
            $pet->name = $request->name;
            $pet->slug = $request->slug;
            $pet->description = $request->description;
            $pet->age = $request->age;
            $pet->gender = $request->gender;
            $pet->status = $request->status;
            $pet->category_id = $request->category;
            $pet->breed_id = $request->breed;
            $pet->is_featured = $request->is_featured;
            $pet->short_description = $request->short_description;
            $pet->related_pets = (!empty($request->related_pets)) ? implode(',',$request->related_pets) : '';
            $pet->save();

            //Save Gallery Pictures
            
            

            $request->session()->flash('success', 'Pet updated successfully');

            return response()->json([
                'status' => true,
                'message' => 'Pet updated successfully'
            ]);

        } else {
            return response()->json([
                'status' => false,
                'errors' => $validator->errors()
            ]);
        }
    }

    public function destroy($id, Request $request) {
        $pet = Pet::find($id);

        if (empty($pet)) {
            $request->session()->flash('error','Pet not Found');

            return response()->json([
                'status' => false,
                'notFound' => true
            ]);
        }

        $petImages = PetImage::where('pet_id',$id)->get();

        if (!empty($petImages)) {
            foreach ($petImages as $petImage) {
                File::delete(public_path('uploads/pet/large/'.$petImage->image));
                File::delete(public_path('uploads/pet/small/'.$petImage->image));
            }
                
            PetImage::where('pet_id',$id)->delete();
        }

        $pet->delete();

        $request->session()->flash('success','Pet deleted successfully');
        
        return response()->json([
            'status' => true,
            'message' => 'Pet deleted successfully'
        ]);
        

    }

    public function getPets(Request $request)
    {
        $tempPet = [];
        if($request->term != ""){
            $pets = Pet::where('name','like','%'.$request->term.'%')->get();

            if ($pets !=null) {
                foreach ($pets as $pet) {
                    $tempPet[] = array('id' => $pet->id, 'text' => $pet->name);
                }
            }
        }


        return response()->json([
            'tags' => $tempPet,
            'status' => true
        ]);

        // print_r($tempPet);

    }
    

}
