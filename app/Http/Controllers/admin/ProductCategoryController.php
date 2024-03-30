<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\ProductCategory;
use App\Models\TempProductImage;
use Illuminate\Support\Facades\File;
use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver;

class ProductCategoryController extends Controller
{
    public function index(Request $request){
        $categories = ProductCategory::latest();


        if(!empty($request->get('keyword'))) {
            $categories = $categories->where('name','like','%'.$request->get('keyword').'%');

        }
        $categories = $categories->paginate(10);
        
        return view('admin.productcategory.list', compact('categories'));
    }

    public function create(){
        return view('admin.productcategory.create');
    }

    public function store(Request $request){
        $validator = Validator::make($request->all(),[
            'name' => 'required',
            'slug' => 'required|unique:product_categories',
        ]);

        if ($validator->passes()){

            $category = new ProductCategory();
            $category->name = $request->name;
            $category->slug = $request->slug;
            $category->status = $request->status;
            $category->save();

            $oldImage = $category->image;

            //Save Image Here
            if(!empty($request->image_id)) {
                $tempImage = TempProductImage::find($request->image_id);
                // Check if tempImage exists
                // if (!$tempImage) {
                //     return response()->json([
                //         'status' => false,
                //         'message' => 'Temp image not found'
                //     ]);
                // }
                $extArray = explode('.',$tempImage->name);
                $ext = last($extArray);

                //ext is the image extention (eg: png, jpg)
                $newImageName = $category->id.'.'.$ext;
                $sPath = public_path().'/temp/'.$tempImage->name; //Source Path
                $dPath = public_path().'/uploads/category/'.$newImageName; //Destination Path
                File::copy($sPath, $dPath);

                //Generate Image Thumbnail
                $dPath = public_path().'/uploads/category/thumb/'.$newImageName; //Destination Path
                $manager = new ImageManager(Driver::class);
                $img = $manager->read($sPath);
                $img->scale(450,600);
                $img->save($dPath);

                $category->image = $newImageName;
                $category->save();
            }


            $request->session()->flash('success','Product Category added successfully');

            return response()->json([
                'status' => true,
                'message' => 'Product Category added successfully'
            ]);

        } else{
            return response()->json([
                'status' => false,
                'errors' => $validator->errors()
            ]);
        }
    }

    public function edit($categoryId, Request $request){
        $category = ProductCategory::find($categoryId);
        if(empty($category)) {
            return redirect()->route('productcategories.index');
        }

        
        return view('admin.productcategory.edit',compact('category'));
    }



    public function update($categoryId, Request $request){

        $category = ProductCategory::find($categoryId);

        if(empty($category)) {
            $request->session()->flash('error','Product Category not found');


            return response()->json([
                'status' => false,
                'notFound' => true,
                'message' => 'Category not found'
            ]);
        }


        $validator = Validator::make($request->all(),[
            'name' => 'required',
            'slug' => 'required|unique:product_categories,slug,'.$category->id.',id',
        ]);

        if ($validator->passes()){

            $category->name = $request->name;
            $category->slug = $request->slug;
            $category->status = $request->status;
            $category->save();

            $oldImage = $category->image;

            //Save Image Here
            if(!empty($request->image_id)) {
                $tempImage = TempProductImage::find($request->image_id);

                // Check if tempImage exists
                if (!$tempImage) {
                    return response()->json([
                        'status' => false,
                        'message' => 'Temp image not found'
                    ]);
                }
                $extArray = explode('.',$tempImage->name);
                $ext = last($extArray);

                //ext is the image extention (eg: png, jpg)
                $newImageName = $category->id.'-'.time().'.'.$ext;
                $sPath = public_path().'/temp/'.$tempImage->name; //Source Path
                $dPath = public_path().'/uploads/category/'.$newImageName; //Destination Path
                File::copy($sPath, $dPath);

                //Generate Image Thumbnail
                $dPath = public_path().'/uploads/category/thumb/'.$newImageName; //Destination Path
                $manager = new ImageManager(Driver::class);
                $img = $manager->read($sPath);
                $img->scale(450,600);
                $img->save($dPath);

                $category->image = $newImageName;
                $category->save();

                //Delete Old Images
                File::delete(public_path().'/uploads/category/thumb/'.$oldImage);
                File::delete(public_path().'/uploads/category/'.$oldImage);
            }


            $request->session()->flash('success','Product Category updated successfully');

            return response()->json([
                'status' => true,
                'message' => 'Catery updated successfully'
            ]);

        } else{
            return response()->json([
                'status' => false,
                'errors' => $validator->errors()
            ]);
        }
    }



    public function destroy($categoryId, Request $request){
        $category = ProductCategory::find($categoryId);
        if(empty($category)) {
            $request->session()->flash('error','Category not found');
            return response()->json([
                'status' => true,
                'message' => 'Category not found'
            ]);
            //return redirect()->route('productcategories.index');
        }

        //Delete Old Images
        File::delete(public_path().'/uploads/category/thumb/'.$category->image);
        File::delete(public_path().'/uploads/category/'.$category->image);

        $category->delete();

        $request->session()->flash('success','Category deleted successfully');

        return response()->json([
            'status' => true,
            'message' => 'Category deleted successfully'
        ]);
    }
}
