<?php

use App\Http\Controllers\InvoiceController;
use Illuminate\Support\Facades\Route;

// Route::get('/', function () {
//     return view('welcome');
// });


Route::view('login','login');
Route::view('admin','admin');
Route::view('AddInvoice','AddInvoice');
Route::view('ShowInvoice','ShowInvoice');
Route::view('ViewInvoice','ViewInvoice');
Route::view('EditInvoice','EditInvoice');


//for login

Route::post('login',[InvoiceController::class,'login']);

//for show invoice form
Route::get('ShowInvoice',[InvoiceController::class,'ShowInvoice']);

//for add invoice
Route::post('AddInvoice',[InvoiceController::class,'AddInvoice']);

//for view invoice
Route::get('ViewInvoice/{id}',[InvoiceController::class,'ViewInvoice']);

//for edit invoice
Route::get('EditInvoice/{id}',[InvoiceController::class,'EditInvoice']);

//for update invoice using post mehtod
Route::post('update',[InvoiceController::class,'update']);

//for logout
Route::get('logout',[InvoiceController::class,'logout']);



