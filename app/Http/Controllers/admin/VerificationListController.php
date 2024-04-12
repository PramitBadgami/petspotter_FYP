<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Verification;

class VerificationListController extends Controller
{
    public function index(Request $request) {

        $verifications = Verification::with('user')
            ->latest('created_at')
            ->get();

        // dd($query->toSql());

        
        

        // $verifications = Verification::leftJoin('users', 'users.id', '=', 'verifications.user_id')
        // ->select('verifications.*', 'users.status as user_status')
        // ->latest('verifications.created_at');

        if ($request->get('keyword') != "") {
            $verifications = $verifications->where('users.name','like','%'.$request->keyword.'%');
            $verifications = $verifications->orwhere('users.email','like','%'.$request->keyword.'%');
            $verifications = $verifications->orwhere('verifications.id','like','%'.$request->keyword.'%');
        }
        

        $verifications = Verification::paginate(4);

        return view('admin.verifications.list',[
            'verifications' => $verifications,
        ]);
    }

    public function detail() {

    }
}
