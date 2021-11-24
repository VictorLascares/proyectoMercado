<?php

//use App\Http\Controllers\QuestionController;
use Illuminate\Support\Facades\Route;
// use App\Http\Controllers\CategoryController;
// use App\Http\Controllers\ProductController;
use App\Models\User;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/


Route::resource('categories', CategoryController::class);
Route::resource('products', ProductController::class);
Route::resource('questions', QuestionController::class);

//Route::post('questions/addAnswer',['App\Http\Controllers\QuestionController','update']);

