<?php

namespace App\Http\Controllers;

use App\Models\Invoice;
use App\Models\AutoRelax;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class InvoiceController extends Controller
{
    function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        $user = AutoRelax::where('email', $request->email)->first();
        dd($user);
        if ($user && Hash::check($request->password, $user->password)) {
            // Log in the user
            Auth::login($user);

            return redirect('invoice');
        } else {
            return redirect()->back()->with('error', 'Invalid credentials');
        }
    }

    function show()
    {
        // $user=AutoRelax::all();
        $user = Invoice::all();
        return view('showlist', ['user' => $user]);
    }

    function add(Request $request)
    {

        try {
            $invoice = new Invoice();
            $lastInvoice = Invoice::orderBy('invoice_no', 'desc')->first();
            $invoice->customer = $request->customer;
            $invoice->item = $request->item;
            $invoice->invoice_no = $lastInvoice->invoice_no + 1;
            $invoice->status = '1';
            $invoice->discount_amount = $request->discount_amount;
            $invoice->discount = $request->discount;
            $invoice->paid_amount = $request->grand_total;
            $invoice->invoice_date = $request->invoice_date;
            $invoice->save();
            
            return redirect('showlist');
        } catch (\Exception $e) {
            dd($e);
            return redirect()->back()->with('error', 'Item could not be added');
        }
    }

    function viewinvoice($id) {
        // dd($id);
        $invoice = Invoice::find($id);
        return view('viewinvoice', compact('invoice')); 
    }
    function editinvoice($id) {
        $invoice = Invoice::find($id);
        return view('editinvoice', compact('invoice')); 
    }

    function update(Request $request){
        try {
            $invoice = Invoice::find($request->id);
            $invoice->customer = $request->customer;
            $invoice->item = $request->item;
            $invoice->discount_amount = $request->discount_amount;
            $invoice->discount = $request->discount;
            $invoice->paid_amount = $request->grand_total;
            $invoice->invoice_date = $request->invoice_date;
            $invoice->save();

            return redirect('showlist');
        } catch (\Exception $e) {
            dd($e);
            return redirect()->back()->with('error', 'Item could not be updated');
        }
    }

    function logout(){
        Auth::logout();
        return redirect('login');
    }
}
