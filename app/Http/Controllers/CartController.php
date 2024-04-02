<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
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
                $message = $product->title.' added to cart';
            } else {
                $status = false;
                $message = $product->title.' already added to cart';
            }

        }else {
            // Cart is empty
            Cart::add($product->id, $product->title, 1, $product->price, ['productImage' => (!empty($product->product_images)) ? $product->product_images->first() : '']); //Show only the First Images 
            $status = true;
            $message = $product->title.' added to cart';
        }

        return response()->json([
           'status' => $status,
           'message' => $message
        ]);
    }

    public function cart() {
        $cartContent = Cart::content();
        // dd($cartContent);
        $data['cartContent'] = $cartContent;
        return view('frontend.cart', $data);
    }
}
