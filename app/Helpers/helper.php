<?php

use App\Mail\OrderEmail;
use App\Mail\VerifyEmail;
use App\Models\ProductCategory;
use App\Models\PetCategory;
use App\Models\ProductImage;
use App\Models\PetImage;
use App\Models\VerificationImage;
use App\Models\Order;
use App\Models\Country;
use App\Models\Verification;
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

function getPetImage($petId){
    return PetImage::where('pet_id',$petId)->first();
}

function getVerificationImage($verificationId){
    return VerificationImage::where('verification_id',$verificationId)->first();
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

function verifyEmail($verificationId) {
    $verification = Verification::with('user')->where('id',$verificationId)->first();

    $mailData = [
        'subject' => "Youe verification status has been updated!!!",
        'verification' => $verification,
       
    ];
    
    Mail::to($verification->email)->send(new VerifyEmail($mailData));
}

function getCountryInfo($id){
    return Country::where('id',$id)->first();
}
?>