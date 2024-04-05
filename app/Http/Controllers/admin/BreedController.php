<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Breed;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;

class BreedController extends Controller
{
    public function index(Request $request) {
        $breeds = Breed::latest('id');

        if($request->get('keyword')) {
            $breeds = $breeds->where('breed','like','%'.$request->keyword.'%');
        }

        $breeds = $breeds->paginate(10);

        return view('admin.breeds.list',compact('breeds'));
    }
    
    public function create() {
        return view('admin.breeds.create');
    }

    public function store(Request $request) {
        $validator = Validator::make($request->all(),[
            'breed' => 'required',
            'slug' => 'required|unique:breeds',
        ]);

        if ($validator->passes()) {
            //Inserts in DB
            $breed = new Breed();
            $breed->breed= $request->breed;
            $breed->slug= $request->slug;
            $breed->status= $request->status;
            $breed->save();

            $request->session()->flash('success','Breed created successfully.');


            return response()->json([
                'status' => true,
                'message' => 'Breed added successfully.'
            ]);

        } else {
            return response()->json([
                'status' => false,
                'errors' => $validator->errors()
            ]);
        }
    }

    public function edit($id, Request $request) {
        $breed = Breed::find($id);

        if(empty($breed)) {
            $request->session()->flash('error','Record not found.');
            return redirect()->route('breeds.index');
        }

        $data['breed'] = $breed;
        return view('admin.breeds.edit',$data);
    }

    public function update($id, Request $request) {

        $breed = Breed::find($id);

        if(empty($breed)) {
            $request->session()->flash('error','Record not found.');
            return response()->json([
                'status' => false,
                'notFound' => true
            ]);
        }

        $validator = Validator::make($request->all(),[
            'breed' => 'required',
            'slug' => 'required|unique:breeds,slug,'.$breed->id.'id',
        ]);

        if ($validator->passes()) {
            
            //saving into the DB
            $breed->breed= $request->breed;
            $breed->slug= $request->slug;
            $breed->status= $request->status;
            $breed->save();

            $request->session()->flash('success','Breed updated successfully.');

            return response()->json([
                'status' => true,
                'message' => 'Breed updated successfully.'
            ]);

        } else {
            return response()->json([
                'status' => false,
                'errors' => $validator->errors()
            ]);
        }
    }

    public function destroy($id, Request $request){
        $breed = Breed::find($id);

        if(empty($breed)) {
            $request->session()->flash('error','Record not found.');
            return response()->json([
                'status' => false,
                'notFound' => true
            ]);
        }

        $breed->delete();

        $request->session()->flash('success','Breed deleted successfully.');

        return response()->json([
            'status' => true,
            'message' => 'Breed deleted successfully.'
        ]);
    }
}
