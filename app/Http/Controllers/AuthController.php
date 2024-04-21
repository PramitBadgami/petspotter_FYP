<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use App\Models\User;
use App\Models\Order;
use App\Models\Wishlist;
use App\Models\Favouritelist;
use App\Models\OrderItem;
use App\Models\Adoption;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Support\Str;
use App\Mail\ResetPasswordEmail;

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
        $user = User::where('id',Auth::user()->id)->first();
        return view('frontend.account.profile',[
            'user' => $user
        ]);
    }

    public function updateProfile(Request $request) {
        $userId = Auth::user()->id;
        $validator = Validator::make($request->all(),[
            'name' => 'required',
            'email' => 'required|email|unique:users,email,'.$userId.'id',
            'phone' => 'required'
        ]);

        if ($validator->passes()) {

            $user = User::find($userId);
            $user->name = $request->name;
            $user->email = $request->email;
            $user->phone = $request->phone;
            $user->save();

            session()->flash('success','Profile updated successfully.');

            return response()->json([
                'status' => true,
                'message' => 'Profile Update succesfully'
            ]);

        } else{
            return response()->json([
                'status' => false,
                'errors' => $validator->errors()    
            ]);
        }
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
        
        $orders = Order::where('user_id', $user->id)->orderBy('created_at', 'DESC')->paginate(10);

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

    public function showChangePasswordForm() {
        return view('frontend.account.change-password');
    }

    public function changePassword(Request $request){
        $validator = Validator::make($request->all(),[
            'old_password' => 'required',
            'new_password' => 'required|min:5',
            'confirm_password' => 'required|same:new_password',
        ]);

        if ($validator->passes()) {


            $user = User::select('id','password')->where('id', Auth::user()->id)->first();

            if (!Hash::check($request->old_password,$user->password)) {
                session()->flash('error', 'Your old password is incorrect, please try again');

                return response()->json([
                    'status' => true,
                ]);
            }

            User::where('id',$user->id)->update([
                'password' => Hash::make($request->new_password)
            ]);

            session()->flash('success', 'Your have successfully changed your password.');

            return response()->json([
                'status' => true,
            ]);

                // dd($user);

        } else {
            return response()->json([
                'status' => false,
                'errors' => $validator->errors()
            ]);
        }
    }

    public function adoptions() {

        $user = Auth::user();

        $adoptions = Adoption::with('pet')->where('user_id',$user->id)->orderBy('created_at', 'DESC')->paginate(4);

        $data['adoptions'] = $adoptions;
        return view('frontend.account.adoption',$data);
    }

    public function forgotPassword() {
        return view('frontend.account.forgot-password');
    }

    public function processForgotPassword(Request $request) {
        $validator = Validator::make($request->all(),[
            'email' => 'required|email|exists:users,email'
        ]);

        if($validator->fails()) {
            return redirect()->route('frontend.forgotPassword')->withInput()->withErrors($validator);
        }

        $token = Str::random(60);

        \DB::table('password_reset_tokens')->where('email', $request->email)->delete();

        \DB::table('password_reset_tokens')->insert([
            'email' => $request->email,
            'token' => $token,
            'created_at' => now()
        ]);

        // Sending Email Here

        $user = User::where('email', '=', $request->email)->first();

        $formData = [
            'token' => $token,
            'user' => $user,
            'mailSubject' => 'You have requested to reset your password'
        ];

        Mail::to($request->email)->send(new ResetPasswordEmail($formData));

        return redirect()->route('frontend.forgotPassword')->with('success','Please check your inbox to reset your password');
    }

    public function resetPassword($token) {

        $tokenExist = \DB::table('password_reset_tokens')->where('token', $token)->first();

        if($tokenExist == null) {
            return redirect()->route('frontend.forgotPassword')->with('error','Invalid request');
        }

        return view('frontend.account.reset-password',[
            'token' => $token
        ]);
    }

    public function processResetPassword(Request $request) {
        $token = $request->token;

        $tokenObj = \DB::table('password_reset_tokens')->where('token', $token)->first();

        if($tokenObj == null) {
            return redirect()->route('frontend.forgotPassword')->with('error','Invalid request');
        }

        $user = User::where('email', $tokenObj->email)->first();

        $validator = Validator::make($request->all(),[
            'new_password' => 'required|min:5',
            'confirm_password' => 'required|same:new_password'
        ]);

        if($validator->fails()) {
            return redirect()->route('frontend.resetPassword',$token)->withErrors($validator);
        }

        User::where('id',$user->id)->update([
            'password' => Hash::make($request->new_password)
        ]);

        \DB::table('password_reset_tokens')->where('email', $user->email)->delete();

        return redirect()->route('account.login')->with('success','You have successfully changed your password');
    }
}
