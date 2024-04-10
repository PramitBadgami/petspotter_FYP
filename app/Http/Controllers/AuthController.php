<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Order;
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
                    return redirect(session()->get('url.intended'));
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
}
