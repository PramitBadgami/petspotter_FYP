<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Order;
use App\Models\Wishlist;
use App\Models\Favouritelist;
use App\Models\OrderItem;
use Gloudemans\Shoppingcart\Facades\Cart;

class AuthController extends Controller
{
    public function login() {
        return view('frontend.account.login');
        
    }

    public function register() {
        return view('frontend.account.register');
    }

    public function processRegister(Request $request) {

        $validator = Validator::make($request->all(),[
            'name' => 'required|min:3',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:5|confirmed'
        ]);

        if($validator->passes()) {

            $user = new User();
            $user->name = $request->name;
            $user->email = $request->email;
            $user->phone = $request->phone;
            $user->password = Hash::make($request->password);
            $user->save();

            session()->flash('success','You have been registered successfully.');

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

    public function authenticate(Request $request) {
        $validator = Validator::make($request->all(),[
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if ($validator->passes()) {

            if(Auth::attempt(['email' => $request->email, 'password' => $request->password],$request->get('remember'))) {

                if (session()->has('url.intended')) {
                    // return redirect(session()->get('url.intended'));
                    
                    // Get the intended URL
                    $intendedUrl = session()->get('url.intended');
                    // Clear the intended URL from session
                    session()->forget('url.intended');
                    // Redirect to the intended URL
                    return redirect($intendedUrl);
                }

                return redirect()->route('account.profile');

            } else{ //when the email/password is invalid
                // session()->flash('error', 'Either email or password is incorrect.');
                return redirect()->route('account.login')
                                ->withInput($request->only('email'))
                                ->with('error', 'Either email or password is incorrect.');
            }

        } else {
            return redirect()->route('account.login')
                            ->withErrors($validator)
                            ->withInput($request->only('email'));
        }
    }

    public function profile() {
        return view('frontend.account.profile');
    }

    public function logout() {
        Auth::logout();
        Cart::destroy();
        return redirect()->route('account.login')
        ->with('success', 'You successfully logged out.');
    }


    public function orders() {
        $data = [];
        $user = Auth::user();
        
        $orders = Order::where('user_id', $user->id)->orderBy('created_at', 'DESC')->get();

        $data['orders'] = $orders;
        return view('frontend.account.order',$data);
    }

    public function orderDetail($id) {
        // echo $id;
        $data = [];
        $user = Auth::user();

        $order = Order::where('user_id', $user->id)->where('id',$id)->first();
        $data['order'] = $order;

        $orderItems = OrderItem::where('order_id', $order->id)->get();
        $data['orderItems'] = $orderItems;

        $orderItemsCount = OrderItem::where('order_id', $order->id)->count();
        $data['orderItemsCount'] = $orderItemsCount;

        return view('frontend.account.order-detail',$data);

    }


    public function wishlist() {

        // returns current logged in user object
        $wishlists = Wishlist::where('user_id',Auth::user()->id)->with('product')->get();
        $data = [];
        $data['wishlists'] = $wishlists;
        return view('frontend.account.wishlist',$data);

    }

    public function removeProductFromWishList(Request $request) {
        $wishlist = Wishlist::where('user_id',Auth::user()->id)->where('product_id',$request->id)->first();

        if($wishlist == null) {
            session()->flash('error','Product already removed from Wishlist.');
            return response()->json([
               'status' => true,
            ]);
        } else {
            Wishlist::where('user_id',Auth::user()->id)->where('product_id',$request->id)->delete();

            session()->flash('success','Product removed successfully.');

            return response()->json([
               'status' => true,
            ]);
        }
    }

    public function favouritelist() {

        // returns current logged in user object
        $favouritelists = Favouritelist::where('user_id',Auth::user()->id)->with('pet')->get();
        $data = [];
        $data['favouritelists'] = $favouritelists;
        
        return view('frontend.account.favouritelist',$data);

    }


    public function removePetFromFavouritelist(Request $request) {
        $favouritelist = Favouritelist::where('user_id',Auth::user()->id)->where('pet_id',$request->id)->first();
        if($favouritelist == null) {
            session()->flash('error','Pet already removed from Favourites List.');
            return response()->json([
               'status' => true,
            ]);
        } else {
            Favouritelist::where('user_id',Auth::user()->id)->where('pet_id',$request->id)->delete();

            session()->flash('success','Pet removed successfully.');

            return response()->json([
               'status' => true,
            ]);
        }
    }
}
