<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class FrontController extends Controller
{
    public function index() {

        $products = Product::where('is_featured','Yes')
                    ->orderBy('id','DESC')
                    ->take(8)
                    ->where('status',1)->get();
        $data['featuredProducts']= $products;

        $latestproducts = Product::orderBy('id','DESC')
                    ->where('status',1)
                    ->take(8)
                    ->get();
        $data['latestproducts']= $latestproducts;

        return view('frontend.home',$data);
    }
}
