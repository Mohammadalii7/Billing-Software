<?php

namespace App\Http\Controllers;

// use App\Models\Autorelax;
use App\Models\Invoice;
use App\Models\Invoiceitem;
// use Illuminate\Http\Request;
// use App\Models\User;
use Barryvdh\DomPDF\Facade\Pdf;

class PDFController extends Controller
{
    public function generatePDF($id)
    {
        $invoice = Invoice::find($id);
        $invoice_items = $invoice->items;


        $pdf = Pdf::loadView('Invoicepdf', compact('invoice', 'invoice_items'));
        $pdf->setPaper('A4', 'portrait'); // Or 'landscape' if needed
        // return $pdf->stream('invoice.pdf');
        return $pdf->download('invoice_' . $invoice->invoice_no . '.pdf');
    }
}
