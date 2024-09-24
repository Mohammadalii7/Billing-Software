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
        return Invoice::select('*')->get();
    }

    public function map($user):array{
        return [
            $user->id,
            $user->customer,
            $user->phone,
            $user->invoice_no,
         $user->status == 1 ? 'Paid' : 'Unpaid',            
          $user->discount,
            $user->discount_amount,
            $user->grand_total,
            $user->invoice_date,
        ];  

    }
    public function headings():array{
        return [
            'id',
            'customer',
            'phone',
            'invoice_no',
            'status',
            'discount',
            'discount_amount',
            'grand_total',
            'invoice_date',
        ];  

    }
}
