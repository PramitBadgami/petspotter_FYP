<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Brand;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class BrandController extends Controller
{
    public function index(Request $request) {
        $brands = Brand::latest('id');

        if($request->get('keyword')) {
            $brands = $brands->where('name','like','%'.$request->keyword.'%');
        }

        $brands = $brands->paginate(10);

        return view('admin.brands.list',compact('brands'));
    }


    public function create() {
        return view('admin.brands.create');
    }

    public function store(Request $request) {
        $validator = Validator::make($request->all(),[
            'name' => 'required',
            'slug' => 'required|unique:brands',
        ]);

        if ($validator->passes()) {
            //Inserts in DB
            $brand = new Brand();
            $brand->name= $request->name;
            $brand->slug= $request->slug;
            $brand->status= $request->status;
            $brand->save();

            $request->session()->flash('success','Brand created successfully.');


            return response()->json([
                'status' => true,
                'message' => 'Brand added successfully.'
            ]);

        } else {
            return response()->json([
                'status' => false,
                'errors' => $validator->errors()
            ]);
        }
    }

    public function edit($id, Request $request) {
        $brand = Brand::find($id);

        if(empty($brand)) {
            $request->session()->flash('error','Record not found.');
            return redirect()->route('brands.index');
        }

        $data['brand'] = $brand;
        return view('admin.brands.edit',$data);
    }



    public function update($id, Request $request) {

        $brand = Brand::find($id);

        if(empty($brand)) {
            $request->session()->flash('error','Record not found.');
            return response()->json([
                'status' => false,
                'notFound' => true
            ]);
        }

        $validator = Validator::make($request->all(),[
            'name' => 'required',
            'slug' => 'required|unique:brands,slug,'.$brand->id.'id',
        ]);

        if ($validator->passes()) {
            
            //saving into the DB
            $brand->name= $request->name;
            $brand->slug= $request->slug;
            $brand->status= $request->status;
            $brand->save();

            $request->session()->flash('success','Brand updated successfully.');

            return response()->json([
                'status' => true,
                'message' => 'Brand updated successfully.'
            ]);

        } else {
            return response()->json([
                'status' => false,
                'errors' => $validator->errors()
            ]);
        }
    }


    public function destroy($id, Request $request){
        $brand = Brand::find($id);

        if(empty($brand)) {
            $request->session()->flash('error','Record not found.');
            return response()->json([
                'status' => false,
                'notFound' => true
            ]);
        }

        $brand->delete();

        $request->session()->flash('success','Brand deleted successfully.');

        return response()->json([
            'status' => true,
            'message' => 'Brand deleted successfully.'
        ]);
    }
}
