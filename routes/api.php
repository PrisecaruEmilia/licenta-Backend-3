<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\VisitorController;
use App\Http\Controllers\Admin\ContactController;

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });

// visitor
Route::get('/get-visitor', [VisitorController::class, 'GetVisitorDetails']);

// contact
Route::post('/post-contact', [ContactController::class, 'PostContactDetails']);
