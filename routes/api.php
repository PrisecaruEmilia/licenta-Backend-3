<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\VisitorController;
use App\Http\Controllers\Admin\ContactController;
use App\Http\Controllers\Admin\SiteInfoController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\HomeSliderController;
use App\Http\Controllers\Admin\ProductDetailsController;
use App\Http\Controllers\Admin\NotificationController;
use App\Http\Controllers\User\AuthController;
use App\Http\Controllers\User\ForgetController;
use App\Http\Controllers\User\ResetController;
// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });


// User LOGIN-REGISTER API

// Login Routes
Route::post('/login', [AuthController::class, 'Login']);

// Register Routes
Route::post('/register', [AuthController::class, 'Register']);

// Forget Password Routes
Route::post('/forget-password', [ForgetController::class, 'ForgetPassword']);

// Reset Password Routes
Route::post('/reset-password', [ResetController::class, 'ResetPassword']);

// END

// visitor
Route::get('/get-visitor', [VisitorController::class, 'GetVisitorDetails']);

// contact
Route::post('/post-contact', [ContactController::class, 'PostContactDetails']);

// site info
Route::get('/all-site-info', [SiteInfoController::class, 'AllSiteInfo']);

// all categories
Route::get('/all-category', [CategoryController::class, 'AllCategory']);


// product list
Route::get('/product-list-remark/{remark}', [ProductController::class, 'ProductListByRemark']);

Route::get('/product-list-category/{category}', [ProductController::class, 'ProductListByCategory']);

Route::get('/product-list-subcategory/{category}/{subcategory}', [ProductController::class, 'ProductListBySubcategory']);

// home slider
Route::get('/all-slider-details', [HomeSliderController::class, 'AllSliderDetails']);

// product details
Route::get('/product-details/{id}', [ProductDetailsController::class, 'ProductDetails']);

// notification
Route::get('/notification', [NotificationController::class, 'NotificationHistory']);

// search
Route::get('/search/{key}', [ProductController::class, 'ProductBySearch']);
