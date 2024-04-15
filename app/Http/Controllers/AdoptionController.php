<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pet;
use App\Models\Adoption;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class AdoptionController extends Controller
{
    public function adopt($slug) {
        

        $pet = Pet::where('slug', $slug)->with('pet_images')->first();

        if (Auth::check() == false) {
            return redirect()->route('account.login');
        }

        return view('frontend.adopt', 
        ['pet' => $pet],
        
        );
    }

    public function processAdopt(Request $request) {

        // Applying validation rules
        $validator = Validator::make($request->all(),[
            'question_1' => 'required',
            'question_2' => 'required',
            'question_3' => 'required',
            'question_4' => 'required',
            'question_5' => 'required',
            'pet_id' => 'required|exists:pets,id',
        ]);

        if($validator->fails()) {
            return response()->json([
                
                'message' => 'Please fill the form with valid details',
                'status' => false,
                'errors' => $validator->errors()
            ]);
        }

        $user = Auth::user();

        $adopt = new Adoption;
        $adopt->user_id = $user->id;
        $adopt->pet_id = $request->pet_id;
        $adopt->answer_1 = $request->question_1;
        $adopt->answer_2 = $request->question_2;
        $adopt->answer_3 = $request->question_3;
        $adopt->answer_4 = $request->question_4;
        $adopt->answer_5 = $request->question_5;

        $adopt->save();

        $pet = Pet::find($request->pet_id);
        if ($pet) {
            $pet->adoption_status = 'in progress';
            $pet->save();
        }

        session()->flash('success', 'You have successfully placed a adoption request.');

        return response()->json([
           'message' => 'Adoption request sent successfully',
           'status' => true,
        ]);
    }

    public function success() {
        return view('frontend.success');
    }
}
