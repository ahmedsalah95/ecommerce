<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\ProductsController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::group(['middleware'=>['auth:api']],function (){

    Route::post('/products',[ProductsController::class,'createProduct']);
    Route::get('/products/{id}',[ProductsController::class,'getProduct']);
    Route::get('/products',[ProductsController::class,'getProducts']);
    Route::put('/products/{id}',[ProductsController::class,'updateProduct']);
    Route::delete('/products/{id}',[ProductsController::class,'deleteProduct']);
    Route::put('/products/{product}/rating', [ProductsController::class, 'updateProductRating']);
    Route::post('/reviews',[ProductsController::class,'addReview']);

});

Route::post('login',[AuthController::class,'login']);
Route::post('register',[AuthController::class,'register']);
