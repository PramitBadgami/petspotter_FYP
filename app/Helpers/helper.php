<?php

use App\Mail\OrderEmail;
use App\Models\ProductCategory;
use App\Models\PetCategory;
use App\Models\ProductImage;
use App\Models\Order;
use App\Models\Country;
use Illuminate\Support\Facades\Mail;

function getCategories(){
    return ProductCategory::orderByRaw("name='dog products' DESC")
                        ->orderByRaw("name='cat products' DESC")
                        ->orderBy('name', 'ASC')
                        ->with('sub_category')
                        ->orderBy('id','DESC')
                        ->where('status',1)
                        ->where('showHome','Yes')
                        ->get();
}

function getPetCategories(){
    return PetCategory::orderByRaw("name='dogs' DESC")
                        ->orderByRaw("name='cats' DESC")
                        ->orderBy('name', 'ASC')
                        ->orderBy('id','DESC')
                        ->where('status',1)
                        ->where('showHome','Yes')
                        ->get();
}

function getProductImage($productId){
    return ProductImage::where('product_id',$productId)->first();
}

function orderEmail($orderId, $userType="customer"){
    $order = Order::where('id',$orderId)->with('items')->first();

    if ($userType == 'customer') {
        $subject = 'Thanks for your order';
        $email = $order->email;
    } else {
        $subject = 'Your have received an order!';
        $email = env('ADMIN_EMAIL');
    }

    $mailData = [
        'subject' => $subject,
        'order' => $order,
        'userType' => $userType
    ];

    Mail::to($email)->send(new OrderEmail($mailData));
}

function getCountryInfo($id){
    return Country::where('id',$id)->first();
}
?>