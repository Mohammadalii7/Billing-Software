@extends('layout')

@section('content')
{{-- <h1>Invoices</h1> --}}
<table class="invoice-table">
    <thead>
        <tr>
            <th>Id</th>
            <th>Customer</th>
            <th>Item</th>
            <th>Invoice No</th>
            <th>Status</th>
            <th>Discount</th>
            <th>Discount Amount</th>
            <th>Paid Amount</th>
            <th>Invoice Date</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($user as $item)
        <tr>
            <td>{{ $item->id }}</td>
            <td>{{ $item->customer }}</td>
            <td>{{ $item->item }}</td>
            <td>{{ $item->invoice_no }}</td>
            <td>{{$item->Status == '1' ? 'unpaid' : 'paid'}}</td>
            <td>{{ $item->discount }}</td>
            <td>{{ $item->discount_amount }}</td>
            <td>{{ $item->paid_amount }}</td>
            <td>{{ $item->invoice_date }}</td>
            <td><a href="ViewInvoice/{{$item->id}}"class="btn btn-outline-secondary">
                    <i class="fa fa-eye"></i> View Invoice
                </a></td>
        </tr>
        @endforeach
    </tbody>
</table>

<style>
    .invoice-table {
        width: 100%;
        border-collapse: collapse;
        margin: 20px 0;
    }

    .invoice-table th,
    .invoice-table td {
        border: 1px solid #ddd;
        padding: 8px;
        text-align: left;
    }

    .invoice-table th {
        background-color: #f4f4f4;
        font-weight: bold;
    }

    .invoice-table tr:nth-child(even) {
        background-color: #f9f9f9;
    }

    .invoice-table tr:hover {
        background-color: #f1f1f1;
    }

    .invoice-table th,
    .invoice-table td {
        text-align: center;
    }

    h1 {
        margin-bottom: 20px;
        font-size: 24px;
        color: #333;
    }

</style>
@endsection
