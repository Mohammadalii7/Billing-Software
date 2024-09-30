<?php

use App\Http\Middleware\CustomAuth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PDFController;
use App\Http\Controllers\ExcelController;
use App\Http\Controllers\InvoiceController;
use App\Http\Middleware\RedirectIfAuthenticated;




Route::view('Home','Home');
// Route::view('admin','admin');
Route::view('AddInvoice','AddInvoice');
Route::view('ShowInvoice','ShowInvoice');
Route::view('ViewInvoice','ViewInvoice');
Route::view('EditInvoice','EditInvoice');

Route::middleware([RedirectIfAuthenticated::class])->group(function(){
    
        Route::view('login','login');
        Route::get('/', function () {
            return view('/login');
        });

        Route::post('login',[InvoiceController::class,'login']);
    });
//for login

Route::middleware([CustomAuth::class,RedirectIfAuthenticated::class])->group(function(){
//for show invoice form
Route::get('ShowInvoice',[InvoiceController::class,'ShowInvoice']);

//for add invoice
Route::post('AddInvoice',[InvoiceController::class,'AddInvoice']);

//for view invoice
Route::get('ViewInvoice/{id}',[InvoiceController::class,'ViewInvoice']);

//for edit invoice
Route::get('EditInvoice/{id}',[InvoiceController::class,'EditInvoice']);

//for update invoice using post mehtod
Route::post('/update/{id}',[InvoiceController::class,'update']);

//for delete invoice
Route::get('delete/{id}',[InvoiceController::class,'muldel']);

//for logout
Route::get('logout',[InvoiceController::class,'logout']);

Route::get('Invoicepdf/{id}', [PDFController::class, 'generatePDF']);

Route::get('exportexcel', [ExcelController::class, 'exportexcel']);



});


