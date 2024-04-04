<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Response;
use Gloudemans\Shoppingcart\Facades\Cart;

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

        // if cart is empty, redirect to login page
        if (Auth::check() == false) {
            session(['url.intended' => url()->current()]);
            return redirect()->route('account.login');
        }

        return view('frontend.checkout');
    }
}
