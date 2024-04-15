<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Adoption;

class AdoptionListController extends Controller
{
    public function index(Request $request) {

        // $search = $request->query('search');

        $adoptions = Adoption::with('user')
                            ->with('pet');

        if ($request->get('keyword') != '') {
            $adoptions = $adoptions->where(function ($query) use ($request) {
                $query->whereHas('user', function ($userQuery) use ($request) {
                    $userQuery->where('name', 'like', '%' . $request->get('keyword') . '%');
                })->orWhereHas('pet', function ($petQuery) use ($request) {
                    $petQuery->where('name', 'like', '%' . $request->get('keyword') . '%');
                });
            });
        }

        $adoptions = $adoptions->paginate(10);

        return view('admin.adoptions.list',[
            'adoptions' => $adoptions
        ]);
    }

    public function detail($adoptionId) {
        // echo $adoptionId;

        $adoptions = Adoption::where('id',$adoptionId)->with('user')
                            ->with('pet')->first();

        return view('admin.adoptions.detail',[
            'adoptions' => $adoptions
        ]);
    }

    public function changeAdoptionStatus(Request $request){
        
    }
}
