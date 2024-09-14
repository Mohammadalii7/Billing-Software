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
Route::view('viewinvoice','viewinvoice');
Route::view('editinvoice','editinvoice');


Route::post('login',[InvoiceController::class,'login']);

Route::get('showlist',[InvoiceController::class,'show']);


Route::post('add',[InvoiceController::class,'add']);

Route::get('viewinvoice/{id}',[InvoiceController::class,'viewinvoice']);
Route::get('editinvoice/{id}',[InvoiceController::class,'editinvoice']);
Route::post('update',[InvoiceController::class,'update']);
Route::get('');

Route::get('logout',[InvoiceController::class,'logout']);



