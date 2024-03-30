<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\admin\AdminLoginController;
use App\Http\Controllers\admin\HomeController;
use App\Http\Controllers\admin\ProductCategoryController;
use App\Http\Controllers\admin\PetCategoryController;
use App\Http\Controllers\admin\SubCategoryController;
use App\Http\Controllers\admin\BrandController;
use App\Http\Controllers\admin\TempProductImagesController;
use App\Http\Controllers\admin\TempPetImagesController;
use App\Http\Controllers\admin\ProductController;
use App\Http\Controllers\admin\ProductSubCategoryController;

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

Route::get('/', function () {
    return view('welcome');
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




        Route::get('/product-subcategories', [ProductSubCategoryController::class, 'index'])->name('product-subcategories.index');


        //temp-images.create
        Route::post('/upload-temp-product-image', [TempProductImagesController::class, 'create'])->name('temp-product-images.create');
        Route::post('/upload-temp-pet-image', [TempPetImagesController::class, 'create'])->name('temp-pet-images.create');



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

