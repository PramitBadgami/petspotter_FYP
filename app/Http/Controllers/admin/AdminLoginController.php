<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;


class AdminLoginController extends Controller
{
    public function index(){
        return view('admin.login');
    }

    public function authenticate(Request $request){

        $validator = Validator::make($request->all(),[
            'email' => 'required|email',
            'password' => 'required'
        ]);

        if($validator->passes()){

            //Checking if the email and password are correct or not
            if(Auth::guard('admin')->attempt(['email' => $request->email, 'password'=> 
            $request->password],$request->get('remember'))) {

                //The login details are stored in the $admin variable
                $admin = Auth::guard('admin')->user();

                //role=2 is the admin
                if ($admin->role == 2) {
                    return redirect()->route('admin.dashboard');
                } else {

                    Auth::guard('admin')->logout();
                    return redirect()->route('admin.login')->with('error','You are not authorized to access the admin panel. ');
                }


            } else{
                return redirect()->route('admin.login')->with('error','Either Email/Password is incorrect');
            }

        }else{
            return redirect()->route('admin.login')
                ->withErrors($validator)
                ->withInput($request->only('email'));
        }

    }

    
}
