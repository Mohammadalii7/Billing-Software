<?php

namespace App\Http\Controllers;

use App\Models\Invoice;
use App\Models\Invoiceitem;
use App\Models\Autorelax;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
// use Illuminate\Support\Facades\Hash;

class InvoiceController extends Controller
{
    function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        $user = Autorelax::where('email', $request->email)->first();
        // dd($user);
        if ($user == $request->password) {

            Auth::login($user);

            return redirect('invoice');
        } else {
            return redirect()->back()->with('error', 'Invalid credentials');
        }
    }

    function ShowInvoice()
    {
        $user = Invoice::all();
         dd($user);
        return view('ShowInvoice', ['user' => $user]);
    }

    function AddInvoice(Request $request)
    {
        // dd($request->all());
        try {
            dd();
            $invoice = new Invoice();
            $lastInvoice = Invoice::orderBy('invoice_no', 'desc')->first();
            $invoice->customer = $request->customer;
            $invoice->invoice_no = isset($lastInvoice->invoice_no)  ? $lastInvoice->invoice_no + 1 : 1;
            $invoice->status = '1';
            $invoice->discount_amount = $request->discount_amount;
            $invoice->discount = $request->discount;
            $invoice->paid_amount = $request->grand_total;
            $invoice->invoice_date = $request->invoice_date;
            $invoice->save();

            foreach ($request->item as $index => $item) {
                var_dump($item);
                // Access corresponding fields for each item
                $item[] = $request->item[$index];
                $description[] = $request->description[$index];
                
                
                // Store the data (for example, save to database)
                // You can create a new model for each item
                
            }
            dd('ggg');
            Invoiceitem::create([
                'item' => $item,
                'description' => $description,
                // Add any other necessary fields
            ]);
            return redirect('ShowInvoice');
        } catch (\Exception $e) {
            dd($e);
            return redirect()->back()->with('error', 'Item could not be added');
        }
    }

    function ViewInvoice($id)
    {
        // dd($id);
        $invoice = Invoice::find($id);
        return view('ViewInvoice', compact('invoice'));
    }
    function EditInvoice($id)
    {
        $invoice = Invoice::find($id);
        return view('EditInvoice', compact('invoice'));
    }

    function update(Request $request)
    {
        try {
            $invoice = Invoice::find($request->id);
            $invoice->customer = $request->customer;
            $invoice->item = $request->item;
            $invoice->discount_amount = $request->discount_amount;
            $invoice->discount = $request->discount;
            $invoice->paid_amount = $request->grand_total;
            $invoice->invoice_date = $request->invoice_date;
            $invoice->save();

            return redirect('ShowInvoice');
        } catch (\Exception $e) {
            dd($e);
            return redirect()->back()->with('error', 'Item could not be updated');
        }
    }

    function logout()
    {
        Auth::logout();
        return redirect('login');
    }
}
