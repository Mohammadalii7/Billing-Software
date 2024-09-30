<?php

namespace App\Http\Controllers;

use App\Models\Invoice;
use App\Models\Invoiceitem;
use App\Models\Autorelax;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

// use Illuminate\Support\Facades\Hash;

class InvoiceController extends Controller
{
    function login(Request $request)
    {

        $user = Autorelax::where('email', $request->email)->first();
        // dd($user);
        if ($user && $request->password === $user->password) {

            Auth::login($user);

            return redirect('ShowInvoice');
        } else {
            return redirect()->back()->with('error', 'Invalid credentials');
        }
    }

    function ShowInvoice()
    {
        $user = Invoice::orderBy('id', 'asc')->get();        //  dd($user);
        return view('ShowInvoice', ['user' => $user]);
    }

    function AddInvoice(Request $request)
    {
        try {
            DB::beginTransaction();

            $lastInvoice = Invoice::orderBy('invoice_no', 'desc')->first();
            $invoice_no = isset($lastInvoice->invoice_no)  ? $lastInvoice->invoice_no + 1 : 1000;



            $invoice = new Invoice();
            $invoice->customer = $request->customer;
            $invoice->phone = $request->phone;
            $invoice->invoice_no = $invoice_no;
            $invoice->subtotal = $request->subtotal;
            $invoice->status = '1';
            $invoice->discount_amount = $request->discount_amount;
            $invoice->discount = $request->discount;
            $invoice->grand_total = $request->grand_total;
            $invoice->invoice_date = $request->invoice_date;
            $invoice->due_date = $request->due_date;
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
            return redirect('ShowInvoice')->with('success', 'Invoice Add successfully');
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
        // dd($invoice_items);

        return view('ViewInvoice', compact('invoice', 'invoice_items'));
    }
    function EditInvoice($id)
    {
        $invoice = Invoice::find($id);
        $invoice_items = Invoiceitem::where('invoice_id', $id)->get();
        // dd($invoice);
        return view('EditInvoice', compact('invoice', 'invoice_items'));
    }

    function update(Request $request, $id)
    {
        try {
            DB::beginTransaction();

            // Define validation rules
            $rules = [
                'customer' => 'required|string',
                'subtotal' => 'required|numeric|min:0',
                'discount' => 'required|numeric|min:0',
                'grand_total' => 'nullable|numeric|min:0',
                'item_name' => 'required|array',
                'item_name.*' => 'required|string',
            ];

            // Define custom error messages
            $messages = [
                'customer.required' => 'Customer information is required.',
                'subtotal.required' => 'Subtotal is required and must be a valid number.',
                'subtotal.numeric' => 'Subtotal must be a numeric value.',
                'discount.required' => 'Discount must be provided and must be an integer.',
                'price.required' => 'Price is required and must be a valid number.',
                'grand_total.numeric' => 'Grand total must be a numeric value.',
            ];

            // Create validator instance
            $validator = Validator::make($request->all(), $rules, $messages);

            // If validation fails
            if ($validator->fails()) {
                // Redirect back with custom error messages for specific fields
                return redirect()->back()
                    ->withErrors($validator)
                    ->withInput();
            }

            // dd($request->all());
            // Find the invoice by ID
            Invoice::where('id', $id)
                ->update([
                    'customer' => $request->customer,
                    'phone' => $request->phone,

                    'subtotal' => $request->subtotal,
                    'discount' => $request->discount,
                    'grand_total' => $request->grand_total,
                    'status' => $request->has('status') ? 1 : 0 // Set 'Paid' (1) if the checkbox is checked, otherwise 'Unpaid' (0)
                ]);

            foreach ($request->item_name as $index => $item_name) {
                $item_id = $request->item_id[$index] ?? null; // Assuming you have an item ID in the request

                if ($item_id) {
                    // Find the existing invoice item by its ID and update it                    
                    Invoiceitem::where('id', $item_id)
                        ->update([
                            'item_name' => $item_name,
                            'description' => $request->description[$index],
                            'quantity' => (int) $request->quantity[$index],
                            'price' => $request->price[$index],
                            'totalprice' => $request->totalprice[$index]
                        ]);
                }
            }


            DB::commit();

            return redirect('ShowInvoice')->with('success', 'Invoice updated successfully');
        } catch (\Exception $e) {
            DB::rollback();
            return redirect()->back()->with('error', $e->getMessage());
        }
    }
    function muldel( $id)
    {
        // $id = $_POST['id'];
        try {
            $result = Invoice::destroy($id);
            return redirect('ShowInvoice')->with('success', 'Deleted Successfully');
        } catch (\Throwable $th) {
            return redirect()->back()->with('error', $th->getMessage());
        }
    }

    function logout()
    {
        Auth::logout();
        return redirect('login');
    }
}

























//