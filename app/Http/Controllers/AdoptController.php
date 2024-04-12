<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use App\Models\PetCategory;
use App\Models\Breed;
use App\Models\Pet;
use App\Models\TempProductImage;
use App\Models\VerificationImage;
use App\Models\Verification;
use Illuminate\Support\Facades\File;
use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver;

class AdoptController extends Controller
{
    public function index(Request $request, $categorySlug = null) {
        $categorySelected = '';
        $breedsArray = [];
        
        

        $categories = PetCategory::orderByRaw("name='dogs' DESC")
        ->orderByRaw("name='cats' DESC")->orderBy('name','ASC')->where('status',1)->get();
        $breeds = Breed::orderBy('breed','ASC')->where('status',1)->get();

        //$pets = Pet::orderBy('id','DESC')->where('status',1)->get();
        $pets = Pet::where('status',1);
        
        

        //Apply Filters here
        if (!empty($categorySlug)) {
            $category = PetCategory::where('slug',$categorySlug)->first();
            $pets = $pets->where('category_id',$category->id);
            $categorySelected = $category->id;
        }

        //http://127.0.0.1:8000/shop/dog/dog-food?&brand=17,40,41
        if (!empty($request->get('breeds'))) {
            $breedsArray = explode(',', $request->get('breeds'));
            $pets = $pets->whereIn('breed_id',$breedsArray);
        }

        if($request->get('age_max') != '' && $request->get('age_max') != '') {
            if($request->get('age_max') == 50) {
                $pets = $pets->whereBetween('age',[intval($request->get('age_min')),1000000]);

            }else{
                $pets = $pets->whereBetween('age',[intval($request->get('age_min')),intval($request->get('age_max'))]);
            }

        }

        if(!empty($request->get('search'))) {
            $pets = $pets->where('name','like','%'.$request->get('search').'%');
        }


        if ($request->get('sort') != '') {
            if($request->get('sort') == 'latest') {
                $pets = $pets->orderBy('id','DESC');
            } else if($request->get('sort') == 'age_asc'){
                $pets = $pets->orderBy('age','ASC');
            } else {
                $pets = $pets->orderBy('age','DESC');
            }
        } else {
            $pets = $pets->orderBy('id','DESC');
        }


        $pets = $pets->paginate(6);

        // passing these in the view
        $data['categories'] = $categories;
        $data['breeds'] = $breeds;
        $data['pets'] = $pets;
        $data['categorySelected'] = $categorySelected;
        $data['breedsArray'] = $breedsArray;
        $data['ageMax'] = (intval($request->get('age_max'))== 0) ? 50 : $request->get('age_max');
        $data['ageMin'] = intval($request->get('sort'));
        $data['sort'] = $request->get('sort');

        return view('frontend.adoption',$data);
    }

    public function pet($slug) {
        // echo $slug;
        $pet = Pet::where('slug', $slug)->with('pet_images')->first();
        if ($pet == null) {
            abort(404);
        }

        $relatedPets = [];
        // fetch related pets
        if($pet->related_pets != '') {
            $petArray = explode(',',$pet->related_pets);
            $relatedPets = Pet::whereIn('id',$petArray)->get();
        }

        $user = Auth::user();
        $data['user'] = $user;
        
        $data['pet'] = $pet;
        $data['relatedPets'] = $relatedPets;


        return view('frontend.pet',$data);
    }

    public function verify() {

        // if user is not logged in
        if (Auth::check() == false) {

            if (!session()->has('url.intended')) {

                session(['url.intended' => url()->current()]);

            }
            return redirect()->route('account.login');
        }
    
        session()->forget('url.intended');


        return view('frontend.verification');
    }

    public function processVerify(Request $request) {

        // Applying validation rules

        $validator = Validator::make(request()->all(), [
            'full_name' =>'required|min:3',
            'email' =>'required|email',
            'age' =>'required',
            // 'DOB' =>'required',
            'address' =>'required|min:10',
            'city' =>'required',
            'province' =>'required',
            'zip' =>'required',
            'mobile' =>'required',
            'father' =>'required',
            'document' =>'required'
        ]);

        if ($validator->fails()) {
            return response()->json([
               'status' => false,
               'message' => 'Please fix the errors',
               'errors' => $validator->errors()
            ]);
        }

        // storing data in verification table

        $user = Auth::user();

        $verify = new Verification;
        $verify->user_id = $user->id;
        $verify->name = $request->full_name;
        $verify->province = $request->province;
        $verify->document_type = $request->document;
        $verify->father_spouse = $request->father;

        $verify->email = $request->email;
        $verify->mobile = $request->mobile;
        $verify->age = $request->age;
        $verify->address = $request->address;
        $verify->city = $request->city;
        $verify->zip = $request->zip;
        $verify->save();

        // Update user status
        $user->status = 'in progress';
        $user->save();

        //Save Gallery Pictures
        if(!empty($request->image_array)) {
            foreach ($request->image_array as $temp_image_id) {

                $tempImageInfo = TempProductImage::find($temp_image_id);
                $extArray = explode('.',$tempImageInfo->name);
                $ext = last($extArray); //like jpg,gif,png etc

                //DB store
                $verifyImage = new VerificationImage();
                $verifyImage->verification_id = $verify->id;
                $verifyImage->image = 'NULL';
                $verifyImage->save();

                $imageName = $verify->id.'-'.$verifyImage->id.'-'.time().'.'.$ext;
                // product_id = 4; $product_image_id =1
                // 4-1-12231.jpg/png
                $verifyImage->image=$imageName;
                $verifyImage->save();

                // Generate Product Thumbnails

                // Large Image
                $sourcePath = public_path().'/temp/'.$tempImageInfo->name;
                $destPath = public_path().'/uploads/verify/'.$imageName;
                $manager = new ImageManager(Driver::class);
                $image = $manager->read($sourcePath);
                $image->scale(1400, 1200);
                $image->save($destPath);

                // //Small Image
                // $destPath = public_path().'/uploads/product/small/'.$imageName;
                // $manager = new ImageManager(Driver::class);
                // $image = $manager->read($sourcePath);
                // $image->scale(300,300);
                // $image->save($destPath);
            }
        }

        session()->flash('success', 'You have successfully filled the form');


        return response()->json([
            'status' => true,
            'verifyId' => $verify->id,
            'message' => 'Verification form saved successfully',
        ]);

    }


    public function thankyou() {
        return view('frontend.greets');
    }
}
