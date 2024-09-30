<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use App\Models\Invoice;

class ExportExcel implements FromCollection,WithHeadings , WithMapping
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        $invoices = Invoice::all();
        return $invoices->map(function ($invoice) {
            return [
                $invoice,
                $invoice->items, 
            ];
        });
    }

    public function map($invoice): array
    {
        $mappedData = []; 
        foreach ($invoice[1] as $item) {
            $mappedData[] = [
                $invoice[0]->id, 
                $invoice[0]->customer,   
                $invoice[0]->phone,     
                $invoice[0]->invoice_no,   
                $invoice[0]->status == 1 ? 'Paid' : 'Unpaid', 
                $invoice[0]->discount, 
                $invoice[0]->discount_amount, 
                $invoice[0]->grand_total, 
                $invoice[0]->invoice_date, 
                $item->id, 
                $item->item_name, 
                $item->quantity, 
                $item->price, 
                $item->totalprice, 
                // $item->invoice_id 
            ];
        }

        return $mappedData; // Return the mapped data for export
    }
    public function headings(): array
    {
        return [
            'Invoice ID',
            'Customer',
            'Phone',
            'Invoice No',
            'Status',
            'Discount',
            'Discount Amount',
            'Grand Total',
            'Invoice Date',
            'Item ID',
            'Item Name',
            // 'Description',
            'Quantity',
            'Price',
            'Total Price',
            // 'Invoice ID',
        ];
    }
}
