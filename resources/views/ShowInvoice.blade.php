@extends('layout')

@section('title', 'List Invoice')
@section('content')




<a href="{{url('exportexcel')}}" class="btn btn-outline-secondary my-4">
    <i class="fa fa-download"></i> Export
</a>


<form action="delete/{id}" method="post">
    @csrf

    <table id="myTable" class="invoice-table">
        <thead>
            <tr>
                <th>#</th>
                <th>Id</th>
                <th>Customer</th>
                <th>Contact</th>
                <th>Invoice No</th>
                <th>Status</th>
                <th>Discount</th>
                <th>Discount Amount</th>
                <th>Grand Total</th>
                <th>Invoice Date</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($user as $index=> $item)
            <tr>

                <td>
                    <a href="/delete/{{ $item->id }}"><i class="fa fa-trash" style="color: red;"></i></a>
                </td>

                <td>{{ $index + 1 }}</td>
                <td>{{ $item->customer }}</td>
                <td>{{ $item->phone }}</td>
                <td>{{ $item->invoice_no }}</td>

                <td>
                    @if ($item->status == 1)
                    <span class="badge badge-paid">Paid</span>
                    @else
                    <span class="badge badge-unpaid">Unpaid</span>
                    @endif
                </td>
                <td>{{ $item->discount }}</td>
                <td>{{ $item->discount_amount }}</td>
                <td>{{ $item->grand_total }}</td>
                <td>{{ $item->invoice_date }}</td>
                <td><a href="ViewInvoice/{{$item->id}}" class="btn btn-outline-secondary">
                        <i class="fa fa-eye"></i> View Invoice
                    </a></td>
            </tr>
            @endforeach
        </tbody>
    </table>
</form>

<style>
    /* Badge styles for Paid and Unpaid statuses */
    .badge {
        padding: 5px 15px;
        border-radius: 5px;
        font-weight: bold;
        font-size: 14px;
        display: inline-block;
        text-align: center;
        margin: 0 auto; /* Center badge if needed */
        width: fit-content;
    }

    .badge-paid {
        color: green;
        background-color: #d4edda; /* Light green background for Paid */
        border: 1px solid #c3e6cb;
    }

    .badge-unpaid {
        color: red;
        background-color: #fff3cd; /* Light yellow background for Unpaid */
        border: 1px solid #ffeeba;
    }

    /* Invoice table styles */
    .invoice-table {
        width: 100%;
        max-width: 100%; /* Prevents overflow of the table */
        border-collapse: collapse;
        margin: 20px 0;
        font-size: 14px;
        text-align: center;
    }

    .invoice-table th,
    .invoice-table td {
        border: 1px solid #ddd;
        padding: 10px;
        word-wrap: break-word; /* Prevents content overflow */
        vertical-align: middle; /* Vertically centers table content */
    }

    .invoice-table th {
        background-color: #f8f9fa;
        font-weight: bold;
        color: #333;
    }

    .invoice-table tr:nth-child(even) {
        background-color: #f9f9f9;
    }

    .invoice-table tr:hover {
        background-color: #f1f1f1;
    }

    /* Adjust the action button styles for consistency */
    .btn-action {
        padding: 5px 10px;
        background-color: #007bff;
        color: white;
        border: none;
        border-radius: 3px;
        cursor: pointer;
        font-size: 12px;
    }

    .btn-action:hover {
        background-color: #0056b3;
    }

    /* Headings styles */
    h1 {
        margin-bottom: 20px;
        font-size: 24px;
        color: #333;
        text-align: center;
    }

    /* Responsive adjustments for smaller screens */
    @media (max-width: 1200px) {
        .invoice-table th,
        .invoice-table td {
            font-size: 12px;
        }
    }

    @media (max-width: 768px) {
        .invoice-table th,
        .invoice-table td {
            font-size: 10px;
            padding: 8px;
        }

        .btn-action {
            font-size: 10px; /* Reduce button font size on smaller screens */
            padding: 3px 8px;
        }
    }

    /* Scrollable table container for smaller screens */
    .table-container {
        overflow-x: auto; /* Horizontal scrolling */
        max-width: 100%; /* Ensure the container doesn't exceed screen size */
    }

</style>

@endsection