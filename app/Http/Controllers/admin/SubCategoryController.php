<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\ProductCategory;
use App\Models\SubCategory;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;

class SubCategoryController extends Controller
{

    public function index(Request $request) {
        $subCategories = SubCategory::select('sub_categories.*','product_categories.name as categoryName')
                            ->latest('sub_categories.id')
                            ->leftJoin('product_categories','product_categories.id','sub_categories.category_id');

        //Serching based on sub category name and product category names repectively
        if(!empty($request->get('keyword'))) {
            $subCategories = $subCategories->where('sub_categories.name','like','%'.$request->get('keyword').'%');
            $subCategories = $subCategories->orWhere('product_categories.name','like','%'.$request->get('keyword').'%');
        }

        //Pagination
        $subCategories = $subCategories->paginate(10);
        
        return view('admin.sub_category.list', compact('subCategories'));
    }


    public function create() {
        $categories = ProductCategory::orderBy('name','ASC')->get();
        $data['categories'] = $categories;
        return view('admin.sub_category.create', $data);
    }

    public function store(Request $request) {
        $validator = Validator::make($request->all(),[
            'name' => 'required',
            'slug' => 'required|unique:sub_categories',
            'category' => 'required',
            'status' => 'required'
        ]);

        if ($validator->passes()) {

            $subCategory = new SubCategory();
            $subCategory->name = $request->name;
            $subCategory->slug = $request->slug;
            $subCategory->status = $request->status;
            $subCategory->category_id = $request->category;
            $subCategory->save();

            $request->session()->flash('success','Sub Category created successfully.');

            return response([
                'status' => true,
                'message' => 'Sub Category created successfully.'
            ]);

        } else {
            return response([
                'status' => false,
                'errors' => $validator->errors()
            ]);
        }
    }

    public function edit($id, Request $request) {

        $subCategory = SubCategory::find($id);
        if (empty($subCategory)) {
            $request->session()->flash('error','Record not found');
            return redirect()->route('sub-categories.index');
        }

        $categories = ProductCategory::orderBy('name','ASC')->get();
        $data['categories'] = $categories;
        $data['subCategory'] = $subCategory;
        return view('admin.sub_category.edit', $data);
    }


    public function update($id, Request $request) {

        $subCategory = SubCategory::find($id);

        if (empty($subCategory)) {
            $request->session()->flash('error','Record not found');
            return response([
                'status' => false,
                'notFound' => true
            ]);
            //return redirect()->route('sub-categories.index');
        }

        $validator = Validator::make($request->all(),[
            'name' => 'required',
            //'slug' => 'required|unique:sub_categories',
            'slug' => 'required|unique:sub_categories,slug,'.$subCategory->id.',id',

            'category' => 'required',
            'status' => 'required'
        ]);

        if ($validator->passes()) {

            $subCategory->name = $request->name;
            $subCategory->slug = $request->slug;
            $subCategory->status = $request->status;
            $subCategory->category_id = $request->category;
            $subCategory->save();

            $request->session()->flash('success','Sub Category updaetd successfully.');

            return response([
                'status' => true,
                'message' => 'Sub Category updated successfully.'
            ]);

        } else {
            return response([
                'status' => false,
                'errors' => $validator->errors()
            ]);
        }
    }


    public function destroy($id, Request $request) {
        $subCategory = SubCategory::find($id);

        if (empty($subCategory)) {
            $request->session()->flash('error','Record not found');
            return response([
                'status' => false,
                'notFound' => true
            ]);
        }

        $subCategory->delete();

        $request->session()->flash('success','Sub Category deleted successfully.');

        return response([
            'status' => true,
            'message' => 'Sub Category deleted successfully.'
        ]);
    }
}
