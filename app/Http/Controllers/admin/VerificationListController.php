<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Verification;

class VerificationListController extends Controller
{
    public function index(Request $request) {

        
        $verifications = Verification::with('user')->latest();

        if ($request->has('keyword')) {
            $keyword = $request->keyword;
            $verifications->where(function ($verifications) use ($keyword) {
                $verifications->where('name', 'like', '%' . $keyword . '%')
                    ->orWhere('email', 'like', '%' . $keyword . '%')
                    ->orWhere('verifications.id', 'like', '%' . $keyword . '%');
            });
        }

        $verifications = $verifications->paginate(10);
      

        return view('admin.verifications.list',[
            'verifications' => $verifications,
        ]);
    }

    public function detail($verificationId) {
        // echo $verificationId;

        $verification = Verification::with('user')->where('id',$verificationId)->first();
        
        return view('admin.verifications.detail',[
            'verification' => $verification
        ]);
    }

    // Define a method in the controller to update the user status
    public function updateUserStatus($id, Request $request) {
        $verification = Verification::findOrFail($id);
        $verification->user->status = $request->status;
        $verification->user->save();

        // send verification email
        verifyEmail($verification->id);

        return response()->json(['success' => true]);
    }
}
