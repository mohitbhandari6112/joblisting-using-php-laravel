<?php

use App\Http\Controllers\ListingController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;


Route::get('/', [ListingController::class, 'index']);

//show create form
Route::get('/listings/create', [ListingController::class, 'create'])->middleware('auth');

//store listing data
Route::post('/listings', [ListingController::class, 'store'])->middleware('auth');

//show edit form
Route::get('/listings/{listing}/edit', [ListingController::class, 'edit'])->middleware('auth');

//update
Route::put('/listings/{listing}', [ListingController::class, 'update'])->middleware('auth');

//deleteting listing
Route::delete('/listings/{listing}', [ListingController::class, 'destroy'])->middleware('auth');


//manage listings
Route::get('/listings/manage', [ListingController::class, 'manage'])->middleware('auth');

//single listing
Route::get('/listings/{listing}', [ListingController::class, 'show']);


//show register create form
Route::get('/register', [UserController::class, 'register'])->middleware('guest');

//creating a new user
Route::post('/users', [UserController::class, 'store']);

//Log user out
Route::post('/logout', [UserController::class, 'logout'])->middleware('auth');

//Show login form

Route::get('/login', [UserController::class, 'login'])->name('login')
    ->middleware('guest');

Route::post('/users/authenticate', [UserController::class, 'authenticate']);







// Route::get('/posts',function(){
//     // dd($id);
//     return response()->json([
//         "posts"=>[
//             ["title"=>"the gutungtung"]
//         ]
//         ]);
// });
