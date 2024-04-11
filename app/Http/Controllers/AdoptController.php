<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PetCategory;
use App\Models\Breed;
use App\Models\Pet;

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


        $data['pet'] = $pet;
        $data['relatedPets'] = $relatedPets;


        return view('frontend.pet',$data);
    }
}
