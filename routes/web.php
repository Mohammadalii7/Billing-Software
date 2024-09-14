<?php

use App\Http\Controllers\InvoiceController;
use Illuminate\Support\Facades\Route;

// Route::get('/', function () {
//     return view('welcome');
// });


Route::view('login','login');
Route::view('admin','admin');
Route::view('invoice','invoice');
Route::view('showlist','showlist');
Route::view('update','update');

Route::post('login',[InvoiceController::class,'login']);

Route::get('showlist',[InvoiceController::class,'show']);


Route::post('add',[InvoiceController::class,'add']);

Route::get('update/{id}',[InvoiceController::class,'edit']);
Route::post('update/{id}',[InvoiceController::class,'update']);



Route::get('logout',[InvoiceController::class,'logout']);



