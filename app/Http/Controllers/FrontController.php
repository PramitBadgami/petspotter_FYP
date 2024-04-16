<?php

namespace App\Http\Controllers;

use App\Mail\ContactEmail;
use App\Models\Product;
use App\Models\Pet;
use App\Models\User;
use App\Models\Wishlist;
use App\Models\Favouritelist;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Mail;

class FrontController extends Controller
{
    public function index() {

        $pets = Pet::where('is_featured','Yes')
                    ->orderBy('id','DESC')
                    ->take(8)
                    ->where('adoption_status', 'Not Adopted')
                    ->where('status',1)->get();
        $data['featuredPets']= $pets;

        $latestpets = Pet::orderBy('id','DESC')
                    ->where('adoption_status', 'Not Adopted')
                    ->where('status',1)
                    ->take(8)
                    ->get();
        $data['latestpets']= $latestpets;

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

    public function addToWishlist(Request $request){

        if (Auth::check() == false) {

            session(['url.intended' => url()->previous()]);

            return response()->json([
                'status' => false,
                'message' => 'Please login to add to wishlist'
            ]);
        }

        Wishlist::updateOrCreate(
            // used as where clause (to check that item is already in the wishlist)
            [
                'user_id' => Auth::user()->id,
                'product_id' => $request->id,
            ],
            [
                'user_id' => Auth::user()->id,
                'product_id' => $request->id,
            ]
        );

        // $wishlist = new Wishlist;
        // $wishlist->user_id = Auth::user()->id;
        // $wishlist->product_id = $request->id;
        // $wishlist->save();

        $product = Product::where('id',$request->id)->first();

        if ($product==null) {
            return response()->json([
                'status' => true,
                'message' => '<div class="alert alert-danger">Product not found</div>'
            ]);
        }

        return response()->json([
            'status' => true,
            'message' => '<div class="alert alert-success"><strong>"'.$product->title.'"</strong> successfully added in your wishlist</div>'
        ]);
    }

    public function addToFavouritelist(Request $request){
        if (Auth::check() == false) {
            session(['url.intended' => url()->previous()]);

            return response()->json([
                'status' => false,
                'message' => 'Please login to add to favourites list'
            ]);
        }

        Favouritelist::updateOrCreate(
            // used as where clause (to check that pet is already in the favourites list)
            [
                'user_id' => Auth::user()->id,
                'pet_id' => $request->id,
            ],
            [
                'user_id' => Auth::user()->id,
                'pet_id' => $request->id,
            ]
        );

        $pet = pet::where('id',$request->id)->first();

        if ($pet==null) {
            return response()->json([
                'status' => true,
                'message' => '<div class="alert alert-danger">Pet not found</div>'
            ]);
        }

        // $favouritelist = new Favouritelist;
        // $favouritelist->user_id = Auth::user()->id;
        // $favouritelist->pet_id = $request->id;
        // $favouritelist->save();

        return response()->json([
            'status' => true,
            'message' => '<div class="alert alert-success"><strong>"'.$pet->name.'"</strong> successfully added in your favourites list</div>'
        ]);
    }

    public function aboutUs(){
        return view('frontend.about');
    }

    public function contactUs(){
        return view('frontend.contact-us');
    }

    public function sendContactEmail(Request $request){
        $validator = Validator::make($request->all(),[
           'name' => 'required',
           'email' => 'required|email',
           'subject' => 'required|min:5',
        ]);

        if($validator->passes()) {

            // send email here

            $mailData = [
                'name' => $request->name,
                'email' => $request->email,
                'subject' => $request->subject,
                'message' => $request->message,
                'mail_subject' => 'You have received a contact email',
            ];

            $admin = User::where('id', 1)->first();

            Mail::to($admin->email)->send(new ContactEmail($mailData));

            session()->flash('success', 'Thanks for contacting us, we will get back to you soon.');
            
            return response()->json([
                'status' => true,
             ]);

        } else {
            return response()->json([
               'status' => false,
               'errors' => $validator->errors()
            ]);
        }
    }
}
