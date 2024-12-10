<?php

use App\Http\Controllers\Api\CategoryController;
use App\Http\Controllers\Api\CityController;
use App\Http\Controllers\Api\PackageController;
use App\Http\Controllers\Api\SubscriptionController;
use App\Http\Controllers\Api\TestimonialController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::get('/catering-package/{package:slug}', [PackageController::class, 'show']);
Route::apiResource('/catering-packages', PackageController::class);

Route::get('/filters/catering-packages', [CategoryController::class, 'filterPackages']);

Route::get('/category/{category:slug}', [CategoryController::class, 'show']);
Route::apiResource('/categories', CategoryController::class);

Route::get('/city/{city:slug}', [CityController::class, 'show']);
Route::apiResource('/cities', CityController::class);

Route::apiResource('/testimonials', TestimonialController::class);

Route::post('/booking-transaction', [SubscriptionController::class, 'store']);
Route::post('/check-booking', [SubscriptionController::class, 'booking_details']);
