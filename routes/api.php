<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\AuthController;
use App\Http\Controllers\API\BrandController;
use App\Http\Controllers\API\OrderController;
use App\Http\Controllers\API\BannerController;
use App\Http\Controllers\API\RegionController;
use App\Http\Controllers\API\PaymentController;
use App\Http\Controllers\API\ProductController;
use App\Http\Controllers\API\CategoryController;
use App\Http\Controllers\API\CustomerController;
use App\Http\Controllers\API\DeliveryFeeController;
use App\Models\Currency;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });

//auth
Route::prefix('v1')->group(function () {
    Route::post('login', [AuthController::class,'login']);
    Route::post('register', [AuthController::class,'register']);
    Route::get('logout', [AuthController::class,'logout'])->middleware('auth:api');

    //banners
    Route::get('banners', [BannerController::class,'index']);

    //brands
    Route::get('brands', [BrandController::class,'index']);

    //category
    Route::get('categories', [CategoryController::class,'index']);

    //products
    Route::get('/products', [ProductController::class, 'listing']);
    Route::get('products/{id}', [ProductController::class,'detail']);
    Route::get('products/{id}/images',[ProductController::class,'productImages']);

    //currency
    Route::get('/currency', function(){
        $rate = Currency::first();
        return response()->json([
            'success' => true,
            'data' => $rate->kyats,
        ], 200);
    });
});

Route::prefix('v1')->middleware(['auth:api','bannedCustomerCheck'])->group(function () {
    //customers
    Route::get('customer', [CustomerController::class,'index']);
    Route::put('customer', [CustomerController::class,'update']);
    Route::delete('customer', [CustomerController::class,'deleteCustomer']);
    Route::put('customer/update-password', [CustomerController::class,'updatePassword']);

    //regions & cash on delivery
    Route::get('regions',[RegionController::class,'list']);
    Route::get('regions/{id}',[RegionController::class,'detail']);

    Route::get('delivery-fees',[DeliveryFeeController::class,'list']);
    Route::get('delivery-fees/{id}',[DeliveryFeeController::class,'detail']);
    Route::get('delivery-fees/regions/{regionId}',[DeliveryFeeController::class,'deliveryFeeByRegion']);

    //payments
    Route::get('payments', [PaymentController::class,'index']);

    //order
    Route::post('orders', [OrderController::class,'create']);
    Route::get('orders/{id}', [OrderController::class,'detail']);
    Route::get('orders', [OrderController::class,'list']);

});
