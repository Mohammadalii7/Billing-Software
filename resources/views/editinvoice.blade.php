@extends('layout')

@section('title', 'Update Invoice')

@section('content')
<div class="container mt-4">
    <div class="card pop-animation">
        <div class="card-header">
            <h4><i class="fas fa-file-invoice"></i> Invoices</h4>
        </div>

        <div class="card-body">
            <div class="modal-body">
                
                <form action="{{url('update',$invoice->id)}}" method="post">
                    @csrf
             
                    <div class="mb-3">
                        <label for="customer" class="form-label">Customer</label>
                        <input type="text" class="form-control" id="customer" name="customer" value="{{$invoice->customer}}">
                    </div>

                   
                    <div class="table-responsive">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>Item</th>
                                    <th>Description</th>
                                    <th>Quantity</th>
                                    <th>Price</th>
                                    <th>Total</th>
                                </tr>
                            </thead>
                            <tbody id="invoiceItems">
                                @foreach($invoice_items as $key => $item)
                                <tr>
                                    <td><input type="text" class="form-control" name="item[]" value="{{ $item->item_name }}"></td>
                                    <td><input type="text" class="form-control" name="description[]" value="{{ $item->description }}"></td>
                                    <td><input type="number" class="form-control quantity" name="quantity[]" value="{{ $item->quantity }}" oninput="calculateTotal(this)"></td>
                                    <td><input type="number" class="form-control price" name="price[]" value="{{ $item->price }}" oninput="calculateTotal(this)"></td>
                                    <td><input type="number" class="form-control itemTotal" readonly value="{{ $item->totalprice }}"></td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                    <div class="row mt-3">
                        <div class="col-md-4">
                            <label for="subtotal" class="form-label">Subtotal</label>
                            <input type="number" class="form-control" id="subtotal" name="subtotal" value="{{$invoice->subtotal}}" readonly>
                        </div>
                        <div class="col-md-4">
                            <label for="discount" class="form-label">Discount (%)</label>
                            <input type="number" class="form-control" id="discount" name="discount" value="{{$invoice->discount}}" oninput="calculateGrandTotal()">
                        </div>
                        <div class="col-md-4">
                            <label for="grandTotal" class="form-label">Grand Total</label>
                            <input type="number" class="form-control" id="grandTotal" name="grand_total" value="{{$invoice->grand_total}}" readonly>
                        </div>
                    </div>

                    <div class="d-flex justify-content-end mt-4">
                        <button type="submit" class="btn btn-success"><i class="fas fa-save"></i> Save Changes</button>
                    </div>
                </form>
                <!-- Form Ends -->
            </div>
            <!-- Modal Ends -->
        </div>
    </div>
</div>
<style>
    @keyframes popIn {
        0% {
            transform: scale(0.9);
            opacity: 0;
        }

        100% {
            transform: scale(1);
            opacity: 1;
        }
    }

    .pop-animation {
        animation: popIn 0.3s ease-out;
        transform-origin: center center;
    }
</style>
<script>
    // Function to calculate the total for each row (quantity * price)
    function calculateTotal(element) {
        const row = element.closest('tr');
        const quantity = row.querySelector('.quantity').value;
        const price = row.querySelector('.price').value;
        const itemTotal = row.querySelector('.itemTotal');

        const total = parseFloat(quantity) * parseFloat(price);
        itemTotal.value = isNaN(total) ? 0 : total.toFixed(2); // Set item total

        calculateSubtotal(); // Update subtotal when quantity or price changes
        calculateGrandTotal(); // Update grand total when subtotal changes
    }

    // Function to calculate the subtotal (sum of all item totals)
    function calculateSubtotal() {
        let subtotal = 0;
        document.querySelectorAll('.itemTotal').forEach(function(item) {
            subtotal += parseFloat(item.value) || 0;
        });
        document.getElementById('subtotal').value = subtotal.toFixed(2); // Set subtotal
    }

    // Function to calculate the grand total (subtotal - discount)
    function calculateGrandTotal() {
        const subtotal = parseFloat(document.getElementById('subtotal').value) || 0;
        const discount = parseFloat(document.getElementById('discount').value) || 0;
        
        const discountAmount = subtotal * (discount / 100);
        const grandTotal = subtotal - discountAmount;

        document.getElementById('grandTotal').value = grandTotal.toFixed(2); // Set grand total
    }

    // Add animation when DOM is fully loaded
    document.addEventListener('DOMContentLoaded', (event) => {
        document.querySelector('.card').classList.add('pop-animation');
    });
</script>
@endsection
