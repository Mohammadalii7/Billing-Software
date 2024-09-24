<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Invoice</title>
     <link rel="icon" type="image/png/jpg" href="{{ asset('assets/css/Logo1.png') }}">  
    <title>Invoice Info</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            padding: 20px;
        }

        .container {
            width: 80%;
            margin: 20px auto;
            background-color: #fff;
            padding: 20px;
            border: 1px solid #ccc;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        }

        h1 {
            font-size: 50px;
            color: grey;
            text-align: center;
            margin-bottom: 20px;
            font-family:italic;
        }

        .unpaid {
            color: red;
            font-weight: bold;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }

        table th,
        table td {
            border: 1px solid #000;
            padding: 12px;
            text-align: center;
        }

        .account-info {
            margin-bottom: 20px;
        }

        .actions {
            text-align: center;
            margin-top: 20px;
        }

        .actions .btn {
            margin: 5px;
            padding: 10px 20px;
            font-size: 16px;
        }

        .actions .btn i {
            margin-right: 8px;
        }

        .badge-paid {
            color: green;
            font-size:15px;
         
       
            /* Light green background */

        }

        .badge-unpaid {
            color: red;
            font-size:15px;
         
            /* Light yellow background */
        
        }
        h3{
            font-size: 28px;
            
            text-decoration:underline;
            margin-bottom: 20px;
            font-family:italic;
            font-weight: bold;
        }

    </style>
</head>
<body>
    <div class="container">
        <div class="invoice-info">
            <h1>Invoice Info</h1>
        </div>
        <hr>

        <div class="subscriber-details d-flex justify-content-between">
            <div class="subscriber-info">
                <h3>Customer Info</h3>
                <p><strong>Customer:</strong> {{$invoice->customer}} </p>
                <p><strong>Tax No:</strong> N/A</p>
                <p><strong>Contact:</strong> {{$invoice->phone}}</p>
            </div>
            <div class="invoice-details">
                <h3>Invoice Info {{$invoice->invoice_no}}</h3>
                <p><strong>Invoice Date:</strong> {{$invoice->invoice_date}}</p>
                <p><strong>Due Date:</strong> {{$invoice->due_date}}</p>
                <p><strong>Status:</strong>
                    <!-- Apply 'badge-paid' class for paid, 'badge-unpaid' for unpaid -->
                    <span class="badge {{$invoice->status == 1 ? 'badge-paid' : 'badge-unpaid'}}">
                        {{$invoice->status == 1 ? 'Paid' : 'Unpaid'}}
                    </span>
                </p>
            </div>

        </div>
        <hr>

        <div class="item-info">
            <h3>Item Info</h3>
            <table class="table table-bordered">
                <thead class="table-light">
                    <tr>
                        <th>#</th>
                        <th>Item</th>
                        <th>Quantity</th>
                        <th>Price (₹)</th>
                        <th>Total Price (₹)</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($invoice_items as $key => $invoice_item)
                    <tr>
                        <td>{{$key + 1}}</td>
                        <td>{{$invoice_item->item_name}}</td>
                        <td>{{$invoice_item->quantity}}</td>
                        <td>{{$invoice_item->price}}</td>
                        <td>{{$invoice_item->totalprice}}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <hr>

        <div class="account-info">
            <h3>Account Info</h3>
            <p><strong>Subtotal:</strong> {{$invoice->subtotal}}</p>
            <p><strong>Discount:</strong> {{$invoice->discount}}%</p>
            {{-- <p><strong>Discount Amount:</strong> {{$invoice->discount_amount}}</p> --}}
            <p><strong>Paid Amount:</strong> {{$invoice->grand_total}}</p>
        </div>
        <hr>

        <div class="actions">
            <!-- Print Button -->
            <a class="btn btn-success" href="{{url('Invoicepdf',$invoice->id)}}">
                <i class="fas fa-print"></i> Print Invoice
            </a>

            <!-- Edit Button -->
            <a href="{{ url('EditInvoice/'.$invoice->id) }}" class="btn btn-primary">
                <i class="fas fa-edit"></i> Edit Invoice
            </a>
        </div>
    </div>

    <!-- Bootstrap JS and dependencies (Popper.js and jQuery) -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
