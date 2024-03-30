<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\PetCategory;
use App\Models\TempPetImage;
use Illuminate\Support\Facades\File;
use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver;

class PetCategoryController extends Controller
{
    public function index(Request $request){
        $categories = PetCategory::latest();


        if(!empty($request->get('keyword'))) {
            $categories = $categories->where('name','like','%'.$request->get('keyword').'%');

        }
        $categories = $categories->paginate(10);
        
        return view('admin.petcategory.list', compact('categories'));
    }

    public function create(){
        return view('admin.petcategory.create');
    }

    public function store(Request $request){
        $validator = Validator::make($request->all(),[
            'name' => 'required',
            'slug' => 'required|unique:pet_categories',
        ]);

        if ($validator->passes()){

            $category = new PetCategory();
            $category->name = $request->name;
            $category->slug = $request->slug;
            $category->status = $request->status;
            $category->save();

            $oldImage = $category->image;

            //Save Image Here
            if(!empty($request->image_id)) {
                $tempImage = TempPetImage::find($request->image_id);
                $extArray = explode('.',$tempImage->name);
                $ext = last($extArray);

                //ext is the image extention (eg: png, jpg)
                $newImageName = $category->id.'-'.time().'.'.$ext;
                $sPath = public_path().'/temp/'.$tempImage->name; //Source Path
                $dPath = public_path().'/uploads/petcategory/'.$newImageName; //Destination Path
                File::copy($sPath, $dPath);

                //Generate Image Thumbnail
                $dPath = public_path().'/uploads/petcategory/thumb/'.$newImageName; //Destination Path
                $manager = new ImageManager(Driver::class);
                $img = $manager->read($sPath);
                $img->scale(450,600);
                $img->save($dPath);

                $category->image = $newImageName;
                $category->save();

                //Delete Old Images
                File::delete(public_path().'/uploads/petcategory/thumb/'.$oldImage);
                File::delete(public_path().'/uploads/petcategory/'.$oldImage);
            }

            $request->session()->flash('success','Pet Category added successfully');

            return response()->json([
                'status' => true,
                'message' => 'Catery added successfully'
            ]);

        } else{
            return response()->json([
                'status' => false,
                'errors' => $validator->errors()
            ]);
        }
    }

    public function edit($categoryId, Request $request){
        
        $category = PetCategory::find($categoryId);

        if(empty($category)) {
            return redirect()->route('petcategories.index');
        }

        
        return view('admin.petcategory.edit',compact('category'));
    }


    public function update($categoryId, Request $request){
        $category = PetCategory::find($categoryId);

        if(empty($category)) {
            $request->session()->flash('error','Pet Category not found');


            return response()->json([
                'status' => false,
                'notFound' => true,
                'message' => 'Category not found'
            ]);
        }

        $validator = Validator::make($request->all(),[
            'name' => 'required',
            'slug' => 'required|unique:pet_categories,slug,'.$category->id.',id',
        ]);

        if ($validator->passes()){

            $category->name = $request->name;
            $category->slug = $request->slug;
            $category->status = $request->status;
            $category->save();

            $oldImage = $category->image;

            //Save Image Here
            if(!empty($request->image_id)) {
                $tempImage = TempPetImage::find($request->image_id);
                $extArray = explode('.',$tempImage->name);
                $ext = last($extArray);

                //ext is the image extention (eg: png, jpg)
                $newImageName = $category->id.'-'.time().'.'.$ext;
                $sPath = public_path().'/temp/'.$tempImage->name; //Source Path
                $dPath = public_path().'/uploads/petcategory/'.$newImageName; //Destination Path
                File::copy($sPath, $dPath);

                //Generate Image Thumbnail
                $dPath = public_path().'/uploads/petcategory/thumb/'.$newImageName; //Destination Path
                $manager = new ImageManager(Driver::class);
                $img = $manager->read($sPath);
                $img->scale(450,600);
                $img->save($dPath);

                $category->image = $newImageName;
                $category->save();

                //Delete Old Images
                File::delete(public_path().'/uploads/petcategory/thumb/'.$oldImage);
                File::delete(public_path().'/uploads/petcategory/'.$oldImage);
            }


            $request->session()->flash('success','Pet Category updated successfully');

            return response()->json([
                'status' => true,
                'message' => 'Category updated successfully'
            ]);

        } else{
            return response()->json([
                'status' => false,
                'errors' => $validator->errors()
            ]);
        }
    
    }

    public function destroy($categoryId, Request $request){
        $category = PetCategory::find($categoryId);
        if(empty($category)) {
            $request->session()->flash('error','Pet Category not found');
            return response()->json([
                'status' => true,
                'message' => 'Category not found'
            ]);
            //return redirect()->route('productcategories.index');
        }

        //Delete Old Images
        File::delete(public_path().'/uploads/petcategory/thumb/'.$category->image);
        File::delete(public_path().'/uploads/petcategory/'.$category->image);

        $category->delete();

        $request->session()->flash('success','Pet Category deleted successfully');

        return response()->json([
            'status' => true,
            'message' => 'Pet Category deleted successfully'
        ]);
    }
}
