<?php

namespace App\Http\Controllers;

use App\Models\Invoice;
use App\Models\Invoiceitem;
use App\Models\Autorelax;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

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
        //  dd($user);
        return view('ShowInvoice', ['user' => $user]);
    }

    function AddInvoice(Request $request)
    {
        try {
            DB::beginTransaction();

            $invoice = new Invoice();
            $lastInvoice = Invoice::orderBy('invoice_no', 'desc')->first();
            $invoice->customer = $request->customer;
            $invoice->phone = $request->phone;
            $invoice->invoice_no = isset($lastInvoice->invoice_no)  ? $lastInvoice->invoice_no + 1 : 1;
            $invoice->subtotal=$request->subtotal;
            $invoice->status = '1';
            $invoice->discount_amount = $request->discount_amount;
            $invoice->discount = $request->discount;
            $invoice->paid_amount = $request->grand_total;
            $invoice->invoice_date = $request->invoice_date;
            $invoice->save();

            $invoice_items = array();
            foreach ($request->item_name as $index => $item_name) {
                $invoice_items[$index]['item_name'] = $item_name;
                $invoice_items[$index]['description'] = $request->description[$index];                
                $invoice_items[$index]['quantity'] = (int) $request->quantity[$index];                
                $invoice_items[$index]['price'] = $request->price[$index];                
                $invoice_items[$index]['totalprice'] = $request->totalprice[$index];                
                $invoice_items[$index]['invoice_id'] = $invoice->id;                
            }
            
            Invoiceitem::insert($invoice_items);

            DB::commit();
            return redirect('ShowInvoice');
        } catch (\Exception $e) {
            DB::rollback();
            dd($e);
            return redirect()->back()->with('error', 'Item could not be added');
        }
    }

    function ViewInvoice($id)
    {
        $invoice = Invoice::find($id);
        $invoice_items = Invoiceitem::where('invoice_id', $id)->get();

        return view('ViewInvoice', compact('invoice','invoice_items'));
    }
    function EditInvoice($id)
    {
        $invoice = Invoice::find($id);
        // dd($invoice);
        return view('EditInvoice', compact('invoice'));
    }

    function update(Request $request)
    {
        try {
            $invoice = Invoice::find($request->id);
            dd($invoice);
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
