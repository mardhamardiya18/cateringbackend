<?php

use App\Models\Testimonial;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::get('/catering-package/{package:slug}', [PackageContoller::class, 'show']);
Route::apiResource('/catering-packages', PackageController::class);

Route::get('/filters/catering-packages', [CategoryController::class, 'filterPackages']);

Route::get('/category/{category:slug}', [CategoryContoller::class, 'show']);
Route::apiResource('/categories', CategoryController::class);

Route::get('/city/{city:slug}', [CityController::class, 'show']);
Route::apiResource('/cities', CityContoller::class);

Route::apiResource('/testimonials', [TestimonialController::class, 'store']);

Route::post('/booking-transaction', [SubscriptionContoller::class, 'store']);
Route::post('/check-booking', [SubscriptionController::class, 'booking_details']);
