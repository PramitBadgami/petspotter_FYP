<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\admin\AdminLoginController;
use App\Http\Controllers\admin\HomeController;
use App\Http\Controllers\admin\ProductCategoryController;
use App\Http\Controllers\admin\PetCategoryController;
use App\Http\Controllers\admin\SubCategoryController;
use App\Http\Controllers\admin\BrandController;
use App\Http\Controllers\admin\BreedController;
use App\Http\Controllers\admin\TempProductImagesController;
use App\Http\Controllers\admin\TempPetImagesController;
use App\Http\Controllers\admin\ProductController;
use App\Http\Controllers\admin\ProductSubCategoryController;
use App\Http\Controllers\admin\ProductImageController;
use App\Http\Controllers\admin\PetImageController;
use App\Http\Controllers\admin\PetController;
use App\Http\Controllers\admin\ShippingController;
use App\Http\Controllers\admin\OrderController;
use App\Http\Controllers\admin\VerificationListController;
use App\Http\Controllers\admin\UserController;
use App\Http\Controllers\admin\SettingController;
use App\Http\Controllers\admin\AdoptionListController;


use App\Http\Controllers\FrontController;
use App\Http\Controllers\ShopController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\AdoptController;
use App\Http\Controllers\AdoptionController;


use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// Route::get('/', function () {
//     return view('welcome');
// });

// Route::get('/test', function () {
//     verifyEmail(11);
// });

Route::get('/',[FrontController::class,'index'])->name('frontend.home');
Route::get('/shop/{categorySlug?}/{subCategorySlug?}',[ShopController::class,'index'])->name('frontend.shop');
Route::get('/product/{slug}',[ShopController::class,'product'])->name('frontend.product');
Route::get('/cart',[CartController::class,'cart'])->name('frontend.cart');
Route::post('/add-to-cart',[CartController::class,'addToCart'])->name('frontend.addToCart');
Route::post('/update-cart',[CartController::class,'updateCart'])->name('frontend.updateCart');
Route::post('/delete-item',[CartController::class,'deleteItem'])->name('frontend.deleteItem.cart');
Route::get('/checkout',[CartController::class,'checkout'])->name('frontend.checkout');
Route::post('/process-checkout',[CartController::class,'processCheckout'])->name('frontend.processCheckout');
Route::get('/thanks/{orderId}',[CartController::class,'thankyou'])->name('frontend.thankyou');
Route::post('/get-order-summary',[CartController::class,'getOrderSummary'])->name('frontend.getOrderSummary');
Route::post('/add-to-wishlist',[FrontController::class,'addToWishlist'])->name('frontend.addToWishlist');
Route::post('/add-to-favouritelist',[FrontController::class,'addToFavouritelist'])->name('frontend.addToFavouritelist');
Route::get('/about-us',[FrontController::class,'aboutUs'])->name('frontend.about');
Route::get('/contact-us',[FrontController::class,'contactUs'])->name('frontend.contact-us');
Route::post('/send-contact-email',[FrontController::class,'sendContactEmail'])->name('frontend.sendContactEmail');

//Forgot Password Routes
Route::get('/forgot-password',[AuthController::class,'forgotPassword'])->name('frontend.forgotPassword');
Route::post('/process-forgot-password',[AuthController::class,'processForgotPassword'])->name('frontend.processForgotPassword');
Route::get('/reset-password/{token}',[AuthController::class,'resetPassword'])->name('frontend.resetPassword');
Route::post('/process-reset-password',[AuthController::class,'processResetPassword'])->name('frontend.processResetPassword');

Route::get('/adoption/{categorySlug?}',[AdoptController::class,'index'])->name('frontend.adoption');
Route::get('/pet/{slug}',[AdoptController::class,'pet'])->name('frontend.pet');
Route::get('/verification',[AdoptController::class,'verify'])->name('frontend.verification');
Route::post('/process-verification',[AdoptController::class,'processVerify'])->name('frontend.processVerify');
Route::get('/greets',[CartController::class,'thankyou'])->name('frontend.greets');

Route::get('/adopt/{slug}',[AdoptionController::class,'adopt'])->name('frontend.adopt');
Route::post('/process-adopt',[AdoptionController::class,'processAdopt'])->name('frontend.processAdopt');
Route::get('/success',[AdoptionController::class,'success'])->name('frontend.success');


// Route::get('/register',[AuthController::class,'register'])->name('account.register');
// Route::post('/process-register',[AuthController::class,'processRegister'])->name('account.processRegister');
// Route::get('/login',[AuthController::class,'login'])->name('account.login');



Route::group(['prefix'=>'account'],function(){
    Route::group(['middleware' => 'guest'],function(){
        Route::get('/login',[AuthController::class,'login'])->name('account.login');
        Route::post('/authenticate',[AuthController::class,'authenticate'])->name('account.authenticate');

        Route::get('/register',[AuthController::class,'register'])->name('account.register');
        Route::post('/process-register',[AuthController::class,'processRegister'])->name('account.processRegister');

    });

    Route::group(['middleware' => 'auth'],function(){
        Route::get('/profile',[AuthController::class,'profile'])->name('account.profile');
        Route::post('/update-profile',[AuthController::class,'updateProfile'])->name('account.updateProfile');
        Route::get('/change-password',[AuthController::class,'showChangePasswordForm'])->name('account.changePassword');
        Route::post('/process-change-password',[AuthController::class,'changePassword'])->name('account.processChangePassword');

        Route::get('/my-orders',[AuthController::class,'orders'])->name('account.orders');
        Route::get('/my-wishlist',[AuthController::class,'wishlist'])->name('account.wishlist');
        Route::post('/remove-product-from-wishlist',[AuthController::class,'removeProductFromWishList'])->name('account.removeProductFromWishList');
        Route::get('/my-favouritelist',[AuthController::class,'favouritelist'])->name('account.favouritelist');
        Route::post('/remove-pet-from-favouritelist',[AuthController::class,'removePetFromFavouritelist'])->name('account.removePetFromFavouritelist');
        Route::get('/order-detail/{orderId}',[AuthController::class,'orderDetail'])->name('account.orderDetail');
        Route::get('/logout',[AuthController::class,'logout'])->name('account.logout');

        Route::get('/my-adoptions',[AuthController::class,'adoptions'])->name('account.adoption');
        
    });
});

Route::group(['prefix'=>'admin'],function(){

    Route::group(['middleware' => 'admin.guest'],function(){

        Route::get('/login', [AdminLoginController::class, 'index'])->name('admin.login');
        Route::post('/authenticate', [AdminLoginController::class, 'authenticate'])->name('admin.authenticate');
    });

    Route::group(['middleware' => 'admin.auth'],function(){

        Route::get('/dashboard', [HomeController::class, 'index'])->name('admin.dashboard');
        Route::get('/logout', [HomeController::class, 'logout'])->name('admin.logout');

        // Product Category Routes
        Route::get('/productcategories', [ProductCategoryController::class, 'index'])->name('productcategories.index');

        Route::get('/productcategories/create', [ProductCategoryController::class, 'create'])->name('productcategories.create');
        Route::post('/productcategories', [ProductCategoryController::class, 'store'])->name('productcategories.store');
        Route::get('/productcategories/{productcategories}/edit', [ProductCategoryController::class, 'edit'])->name('productcategories.edit');
        Route::put('/productcategories/{productcategories}', [ProductCategoryController::class, 'update'])->name('productcategories.update');
        Route::delete('/productcategories/{productcategories}', [ProductCategoryController::class, 'destroy'])->name('productcategories.delete');

        // Pet Category Routes
        Route::get('/petcategories', [PetCategoryController::class, 'index'])->name('petcategories.index');

        Route::get('/petcategories/create', [PetCategoryController::class, 'create'])->name('petcategories.create');
        Route::post('/petcategories', [PetCategoryController::class, 'store'])->name('petcategories.store');
        Route::get('/petcategories/{petcategories}/edit', [PetCategoryController::class, 'edit'])->name('petcategories.edit');
        Route::put('/petcategories/{petcategories}', [PetCategoryController::class, 'update'])->name('petcategories.update');
        Route::delete('/petcategories/{petcategories}', [PetCategoryController::class, 'destroy'])->name('petcategories.delete');


        // Sub Category Routes
        Route::get('/sub-categories', [SubCategoryController::class, 'index'])->name('sub-categories.index');

        Route::get('/sub-categories/create', [SubCategoryController::class, 'create'])->name('sub-categories.create');
        Route::post('/sub-categories', [SubCategoryController::class, 'store'])->name('sub-categories.store');
        Route::get('/sub-categories/{subCategories}/edit', [SubCategoryController::class, 'edit'])->name('sub-categories.edit');
        Route::put('/sub-categories/{subCategories}', [SubCategoryController::class, 'update'])->name('sub-categories.update');
        Route::delete('/sub-categories/{petcategories}', [SubCategoryController::class, 'destroy'])->name('sub-categories.delete');


        // Brands Routes
        Route::get('/brands', [BrandController::class, 'index'])->name('brands.index');

        Route::get('/brands/create', [BrandController::class, 'create'])->name('brands.create');
        Route::post('/brands', [BrandController::class, 'store'])->name('brands.store');
        Route::get('/brands/{brand}/edit', [BrandController::class, 'edit'])->name('brands.edit');
        Route::put('/brands/{brand}', [BrandController::class, 'update'])->name('brands.update');
        Route::delete('/brands/{brands}', [BrandController::class, 'destroy'])->name('brands.delete');


        // Products Routes
        Route::get('/products', [ProductController::class, 'index'])->name('products.index');

        Route::get('/products/create', [ProductController::class, 'create'])->name('products.create');
        Route::post('/products', [ProductController::class, 'store'])->name('products.store');
        Route::get('/products/{product}/edit', [ProductController::class, 'edit'])->name('products.edit');
        Route::put('/products/{product}', [ProductController::class, 'update'])->name('products.update');
        Route::delete('/products/{product}', [ProductController::class, 'destroy'])->name('products.delete');
        Route::get('/get-products',[ProductController::class,'getProducts'])->name('products.getProducts');

        Route::get('/product-subcategories', [ProductSubCategoryController::class, 'index'])->name('product-subcategories.index');

        Route::post('/product-images/update', [ProductImageController::class, 'update'])->name('product-images.update');
        Route::delete('/product-images', [ProductImageController::class, 'destroy'])->name('product-images.destroy');

        // Shipping Routes
        Route::get('/shipping/create', [ShippingController::class, 'create'])->name('shipping.create');
        Route::post('/shipping', [ShippingController::class, 'store'])->name('shipping.store');
        Route::get('/shipping/{id}', [ShippingController::class, 'edit'])->name('shipping.edit');
        Route::put('/shipping/{id}', [ShippingController::class, 'update'])->name('shipping.update');
        Route::delete('/shipping/{id}', [ShippingController::class, 'destroy'])->name('shipping.delete');


        // Breeds Routes
        Route::get('/breeds', [BreedController::class, 'index'])->name('breeds.index');
        Route::get('/breeds/create', [BreedController::class, 'create'])->name('breeds.create');
        Route::post('/breeds', [BreedController::class, 'store'])->name('breeds.store');
        Route::get('/breeds/{breed}/edit', [BreedController::class, 'edit'])->name('breeds.edit');
        Route::put('/breeds/{breed}', [BreedController::class, 'update'])->name('breeds.update');
        Route::delete('/breeds/{breeds}', [BreedController::class, 'destroy'])->name('breeds.delete');

        // Pet Routes
        Route::get('/pets', [PetController::class, 'index'])->name('pets.index');
        Route::get('/pets/create', [PetController::class, 'create'])->name('pets.create');
        Route::post('/pets', [PetController::class, 'store'])->name('pets.store');
        Route::get('/pets/{pet}/edit', [PetController::class, 'edit'])->name('pets.edit');
        Route::put('/pets/{pet}', [PetController::class, 'update'])->name('pets.update');
        Route::delete('/pets/{pet}', [PetController::class, 'destroy'])->name('pets.delete');
        Route::get('/get-pets',[PetController::class,'getPets'])->name('pets.getPets');

        Route::post('/pet-images/update', [PetImageController::class, 'update'])->name('pet-images.update');
        Route::delete('/pet-images', [PetImageController::class, 'destroy'])->name('pet-images.destroy');


        // Order Routes
        Route::get('/orders', [OrderController::class, 'index'])->name('orders.index');
        Route::get('/orders/{id}', [OrderController::class, 'detail'])->name('orders.detail');
        Route::post('/order/change-status/{id}', [OrderController::class, 'changeOrderStatus'])->name('orders.changeOrderStatus');
        Route::post('/order/send-email/{id}', [OrderController::class, 'sendInvoiceEmail'])->name('orders.sendInvoiceEmail');

        // Verification Routes
        Route::get('/verifications', [VerificationListController::class, 'index'])->name('verifications.index');
        Route::get('/verifications/{id}', [VerificationListController::class, 'detail'])->name('verifications.detail');
        Route::put('verifications/updateUserStatus/{id}', [VerificationListController::class, 'updateUserStatus'])->name('verifications.updateUserStatus');
        
        // Adoptions Routes
        Route::get('/adoptions', [AdoptionListController::class, 'index'])->name('adoptions.index');
        Route::get('/adoptions/{id}', [AdoptionListController::class, 'detail'])->name('adoptions.detail');
        Route::post('/adoption/change-status/{id}', [AdoptionListController::class, 'changeAdoptionStatus'])->name('adoptions.changeAdoptionStatus');

        // User Route
        Route::get('/users', [UserController::class, 'index'])->name('users.index');


        //temp-images.create
        Route::post('/upload-temp-product-image', [TempProductImagesController::class, 'create'])->name('temp-product-images.create');
        Route::post('/upload-temp-pet-image', [TempPetImagesController::class, 'create'])->name('temp-pet-images.create');

        // Setting Route
        Route::get('/change-password', [SettingController::class, 'showChangePasswordForm'])->name('admin.showChangePasswordForm');
        Route::post('/process-change-password', [SettingController::class, 'processChangePassword'])->name('admin.processChangePassword');


        //this route is returning the slug
        Route::get('/getSlug', function(Request $request){
            $slug = '';
            if(!empty($request->title)) {
                $slug = Str::slug($request->title);
            }

            return response()->json([
                'status' => true,
                'slug' => $slug
            ]);
        })->name('getSlug');

    });



});

