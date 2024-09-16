<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Invoice Info</title>
    <!-- FontAwesome for icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: Arial, sans-serif;
            line-height: 1.6;
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
        h1{
            
            font-family:Arial;
            font-size: 50px;
            color:orange;
        }

        h2, h3 {
            margin-bottom: 15px;
        }

        p {
            margin-bottom: 10px;
            line-height: 1.8;
        }

        hr {
            border: 1px solid #ddd;
            margin: 20px 0;
        }

        .unpaid {
            color: red;
            font-weight: bold;
        }

        .tax-invoice {
            background-color: #ffe4e1;
            padding: 3px 6px;
            border-radius: 3px;
            font-size: 0.9em;
        }

        .subscriber-details {
            display: flex;
            justify-content: space-between;
        }

        .subscriber-info, .invoice-details {
            width: 48%;
        }

        .item-info {
            margin-bottom: 20px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }

        table th, table td {
            border: 1px solid #000;
            padding: 12px;
            text-align: center;
        }

        .account-info {
            margin-bottom: 20px;
        }

        .account-info p {
            margin-bottom: 5px;
        }

        .actions {
            text-align: center;
            margin-top: 20px;
        }

        .actions button {
            background-color: #4CAF50;
            color: #fff;
            padding: 12px 20px;
            margin: 10px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 1em;
            display: inline-flex;
            align-items: center;
        }

        .actions button i {
            margin-right: 8px;
        }

        .actions button:hover {
            background-color: #45a049;
        }

        .actions .edit-btn {
            background-color: #2196F3;
        }

        .actions .edit-btn:hover {
            background-color: #0b7dda;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="invoice-info">
            <h1>Invoice Info</h1>
        </div>
        <hr>
        {{-- {{dd($invoice)}} --}}
        <div class="subscriber-details">
            <div class="subscriber-info">
                <h3>Customer Info</h3>
                <p><strong>Customer:</strong> </p>
                <p><strong>Tax No:</strong></p>
                <p><strong>Contact No:</strong> 7897654253</p>
                <p><strong>Address:</strong> Gujrat Jathpur</p>
            </div>

            <div class="invoice-details">
                <h3>Invoice Info (TX/24-25/1798)</h3>
                <p><strong>Invoice Date:</strong> 2024-09-14</p>
                <p><strong>Status:</strong> <span class="unpaid">Unpaid</span></p>
            </div>
        </div>
        <hr>

        <div class="item-info">
            <h3>Item Info</h3>
            <table>
                <thead>
                    <tr>
                        <th>Id</th>
                        <th>Item </th>
                        <th>Description</th>
                        <th>Quantity</th>
                        <th>Price(₹)</th>
                        <th>Total Price (₹)</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>{{$invoice->id}}</td>
                        <td>{{$invoice->item}}</td>
                        <td>{{$invoice->discount}}</td>
                        <td>{{$invoice->quantity}} </td>
                        <td>{{$invoice->price}}</td>
                        <td>{{$invoice->totalprice}}</td>
                     
                    </tr>
                 
                </tbody>
            </table>
        </div>
        <hr>

        <div class="account-info">
            <h3>Account Info</h3>
            <p><strong>Subtotal:</strong> ₹150.00</p>
            <p><strong>Discount (0.00%):</strong> ₹0.00</p>
            <p><strong>Taxable Amount:</strong> ₹150.00</p>
            <p><strong>Tax Amount:</strong> ₹7.5</p>
            <p><strong>Paid Amount:</strong> ₹0.00</p>
       
        </div>
        <hr>
        <div class="actions">
            <button><i class="fas fa-print"></i>Print Invoice</button>
        <a href="{{ url('EditInvoice/'.$invoice->id) }}" class="btn btn-outline-secondary"><i class="fas fa-edit"></i>Edit</a> 
        </div>
    </div>
</body>
</html>

