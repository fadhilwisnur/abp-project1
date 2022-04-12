<?php

use Illuminate\Support\Facades\Route;

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

Route::get('/', function () {
    return view('login');
});

Auth::routes();
Route::get('/home', [App\Http\Controllers\HotelController::class, 'homeview'])->name('home');
Route::get('/add',[App\Http\Controllers\HotelController::class, 'tambahHotelView']);
Route::post('/tambahhotel',[App\Http\Controllers\HotelController::class, 'tambahHotel']);
Route::get('/hotel/{id}',[App\Http\Controllers\HotelController::class, 'viewhotel']);
Route::get('/hotel/delete/{id}',[App\Http\Controllers\HotelController::class, 'deletehotel']);
Route::get('/hotel/{id}/edit',[App\Http\Controllers\HotelController::class, 'edithotelview']);
Route::put('/edit/{id}',[App\Http\Controllers\HotelController::class, 'update']);

//Comment

Route::post('comments',[App\Http\Controllers\CommentController::class, 'store']);
Route::post('deletecomment',[App\Http\Controllers\CommentController::class, 'deletecomment']);
Route::post('delete-comment',[App\Http\Controllers\CommentController::class, 'destroy']);