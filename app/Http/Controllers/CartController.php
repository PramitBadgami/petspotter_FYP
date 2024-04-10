<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Response;
use Gloudemans\Shoppingcart\Facades\Cart;
use App\Models\Country;
use App\Models\CustomerAddress;
use App\Models\Order;
use App\Models\ShippingCharge;
use App\Models\OrderItem;

class CartController extends Controller
{
    public function addToCart(Request $request) {
        $product = Product::with('product_images')->find($request->id);

        if ($product == null) {
            return response()->json([
               'status' => false,
               'message' => 'Product not found'
            ]);
        }

        if(Cart::count() > 0) {
            //echo "product already added in cart";
            // Products found in cart
            // Check if this product already in the cart
            // Return as message that the product already added in the cart
            // if product not found in the cart, then add product in cart

            $cartContent = Cart::content();
            $productAlreadyExist = false;

            foreach ($cartContent as $item) {
                if ($item->id == $product->id) {
                $productAlreadyExist = true;

                }
            }

            if ($productAlreadyExist == false) {
                Cart::add($product->id, $product->title, 1, $product->price, ['productImage' => (!empty($product->product_images)) ? $product->product_images->first() : '']); //Show only the First Images 
                
                $status = true;
                $message = '<strong>'.$product->title.'</strong>'.'  added to cart successfully.';
                session()->flash('success', $message);
                
            } else {
                $status = false;
                $message = $product->title.' already added to cart';
            }

        }else {
            // Cart is empty
            Cart::add($product->id, $product->title, 1, $product->price, ['productImage' => (!empty($product->product_images)) ? $product->product_images->first() : '']); //Show only the First Images 
            $status = true;
            $message = '<strong>'.$product->title.'</strong>'.'  added to cart successfully.';

            session()->flash('success', $message);
        }

        return response()->json([
           'status' => $status,
           'message' => $message
        ]);
    }

    public function cart() {
        $cartContent = Cart::content();
        //dd($cartContent);
        $data['cartContent'] = $cartContent;
        return view('frontend.cart', $data);
    }

    public function updateCart(Request $request) {
        $rowId = $request->rowId;
        $qty = $request->qty;

        $itemInfo = Cart::get($rowId);

        $product = Product::find($itemInfo->id);
        // check qty available in stock
        if($product->track_qty == 'Yes') {
            if ($qty <= $product->qty) {
                Cart::update($rowId, $qty);
                $message = 'Cart updated successfully';
                $status = true;
                session()->flash('success',$message);

            } else {
                $message = 'Requested quantity('.$qty.') not available in stock.';
                $status = false;
                session()->flash('error',$message);

            }
        } else {
            Cart::update($rowId, $qty);
            $message = 'Cart updated successfully';
            $status = true;
            session()->flash('success',$message);

        }


        return response()->json([
           'status' => $status,
           'message' => $message
        ]);
    }

    public function deleteItem(Request $request) {

        $itemInfo = Cart::get($request->rowId);

        // if item is not available in cart
        if($itemInfo == null) {
            $errorMessage = 'Item not found in cart';
            session()->flash('error',$errorMessage);
            return response()->json([
                'status' => false,
                'message' => $errorMessage
             ]);
        }

        Cart::remove($request->rowId);

        $message = 'Item removed from cart successfully.';

        session()->flash('success',$message);

        return response()->json([
            'status' => true,
            'message' => $message
         ]);
        
    }

    public function checkout(){

        // if cart is empty, redirect to cart page
        if (Cart::count() == 0) {
            return redirect()->route('frontend.cart');
        }

        // if cart is not empty, redirect to login page
        if (Auth::check() == false) {

            if (!session()->has('url.intended')) {

                session(['url.intended' => url()->current()]);

            }

            return redirect()->route('account.login');
        }

        $customerAddress = CustomerAddress::where('user_id', Auth::user()->id)->first();

        

        session()->forget('url.intended');

        $countries = Country::orderBy('name', 'ASC')->get();

        // Calculate shipping charges
        if ($customerAddress != '') {
            $userCountry = $customerAddress->country_id;
            $shippingInfo = ShippingCharge::where('country_id', $userCountry)->first();

            // echo $shippingInfo->amount;

            $totalQty = 0;
            $totalShippingCharge = 0;
            $grandTotal = 0;
            foreach (Cart::content() as $item) {
                $totalQty += $item->qty;
            }
            
            $totalShippingCharge = $totalQty*$shippingInfo->amount;
            $grandTotal = Cart::subtotal(2,'.','')+$totalShippingCharge;

        } else {
            $grandTotal = Cart::subtotal(2,'.','');
            $totalShippingCharge = 0;

        }
        

        return view('frontend.checkout',[
            'countries' => $countries,
            'customerAddress' => $customerAddress,
            'totalShippingCharge' => $totalShippingCharge,
            'grandTotal' => $grandTotal
        ]);
    }

    public function processCheckout(Request $request) {

        // Apply Validation
        // Rules for Validation
        $validator = Validator::make(request()->all(), [
            'first_name' =>'required|min:3',
            'last_name' =>'required',
            'email' =>'required|email',
            'country' =>'required',
            'address' =>'required|min:10',
            'city' =>'required',
            'state' =>'required',
            'zip' =>'required',
            'mobile' =>'required'
        ]);

        if ($validator->fails()) {
            return response()->json([
               'status' => false,
               'message' => 'Please fix the errors',
               'errors' => $validator->errors()
            ]);
        }

        // Save user address

        // $customerAddress = CustomreAddress::find();

        $user = Auth::user();

        CustomerAddress::updateOrCreate(
            ['user_id' => $user->id],
            [
                'user_id' => $user->id,
                'first_name' => $request->first_name,
                'last_name' => $request->last_name,
                'email' => $request->email,
                'mobile' => $request->mobile,
                'country_id' => $request->country,
                'address' => $request->address,
                'apartment' => $request->apartment,
                'city' => $request->city,
                'state' => $request->state,
                'zip' => $request->zip,
            ]
        );

        // storing data in orders table

        if ($request->payment_method == 'cod') {

            $shipping = 0;
            $subTotal = Cart::subtotal(2,'.','');

            // Calculating shipping charges
            $shippingInfo = ShippingCharge::where('country_id',$request->country)->first();

            $totalQty = 0;
            foreach (Cart::content() as $item) {
                $totalQty += $item->qty;
            }

            if ($shippingInfo != null) {                
                $shipping = $totalQty * $shippingInfo->amount;
                $grandTotal = $subTotal + $shipping;

            } else {
                $shippingInfo = ShippingCharge::where('country_id', 'rest_of_world')->first();
                $shipping = $totalQty * $shippingInfo->amount;
                $grandTotal = $subTotal + $shipping;

            }

            
            $order = new Order;
            $order->subtotal = $subTotal;
            $order->shipping = $shipping;
            $order->grand_total = $grandTotal;
            $order->payment_status = 'not paid';
            $order->status = 'pending';
            $order->user_id = $user->id;
            $order->first_name = $request->first_name;
            $order->last_name = $request->last_name;
            $order->email = $request->email;
            $order->mobile = $request->mobile;
            $order->country_id = $request->country;
            $order->address = $request->address;
            $order->apartment = $request->apartment;
            $order->city = $request->city;
            $order->state = $request->state;
            $order->zip = $request->zip;
            $order->notes = $request->order_notes;
            $order->save();

            // store order items in order items table

            foreach (Cart::content() as $item) {
                $orderItem = new OrderItem;
                $orderItem->product_id = $item->id;
                $orderItem->order_id = $order->id;
                $orderItem->name = $item->name;
                $orderItem->qty = $item->qty;
                $orderItem->price = $item->price;
                $orderItem->total = $item->price*$item->qty;
                $orderItem->save();
            }

            // send order email to customer
            orderEmail($order->id, 'customer');

            session()->flash('success', 'You have successfully placed your order');

            Cart::destroy();

            return response()->json([
                'status' => true,
                'orderId' => $order->id,
                'message' => 'Order saved successfully',
            ]);
            

        } else {
            //
        }
    }

    public function thankyou($id) {
        return view('frontend.thanks',[
            'id' => $id
        ]);
    }

    public function getOrderSummary(Request $request){

        $subTotal = Cart::subtotal(2,'.','');

        if($request->country_id>0) {


            $shippingInfo = ShippingCharge::where('country_id',$request->country_id)->first();

            $totalQty = 0;
            foreach (Cart::content() as $item) {
                $totalQty += $item->qty;
            }

            if ($shippingInfo != null) {
                
                $shippingCharge = $totalQty * $shippingInfo->amount;
                $grandTotal = $subTotal + $shippingCharge;

                return response()->json([
                    'status' => true,
                    'grandTotal' => number_format($grandTotal,2),
                    'shippingCharge' => number_format($shippingCharge,2),
                ]);

            } else {
                $shippingInfo = ShippingCharge::where('country_id', 'rest_of_world')->first();

                $shippingCharge = $totalQty * $shippingInfo->amount;
                $grandTotal = $subTotal + $shippingCharge;

                return response()->json([
                    'status' => true,
                    'grandTotal' => number_format($grandTotal,2),
                    'shippingCharge' => number_format($shippingCharge,2),
                ]);
            }

        } else {
            
            return response()->json([
                'status' => true,
                'grandTotal' => number_format($subTotal,2),
                'shippingCharge' => number_format(0,2),
            ]);
        }
    }
}
