<?php

use App\Http\Controllers\Admin\TestimonialController;
Route::resource('testimonial', TestimonialController::class);
use App\Http\Controllers\Admin\FaqController;
Route::resource('faq', FaqController::class);
use App\Http\Controllers\Admin\FaqCategoryController;
Route::resource('faq-category', FaqCategoryController::class);
use App\Http\Controllers\Admin\MakeController;
Route::resource('make', MakeController::class);

use App\Http\Controllers\Admin\VehicleController;
Route::resource('vehicle', VehicleController::class);
Route::post('/vehicle/delete-image', [VehicleController::class, 'deleteImages'])->name('vehicle.delete_img');
Route::post('/vehicle/crash/delete-image', [VehicleController::class, 'crashDeleteImages'])->name('vehicle.crash.delete_img');
Route::post('/vehicle/accept-car', [VehicleController::class, 'acceptcar'])->name('vehicleDetail.acceptCar');

use App\Http\Controllers\Admin\BodyStyleController;
Route::resource('body-style', BodyStyleController::class);
use App\Http\Controllers\Flagged\FlaggedController;
Route::resource('flagged', FlaggedController::class);
