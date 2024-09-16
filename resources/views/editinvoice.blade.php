@extends('layout')

@section('title', 'Update Invoice')

@section('content')
<div class="container mt-4">
    <div class="card">
        <div class="card-header">
            <h4><i class="fas fa-file-invoice"></i> Invoices</h4>
        </div>

        <div class="card-body">
            <div class="modal-body">
                <!-- Update Form -->
                <form action="update" method="post">
                    @csrf
                    {{-- @method('PUT') <!-- HTTP PUT method --> --}}

                    <!-- Customer Input -->
                    <div class="mb-3">
                        <label for="customer" class="form-label">Customer</label>
                        <input type="text" class="form-control" id="customer" name="customer" value="{{$invoice->customer}}">
                    </div>

                    <!-- Responsive Items Table -->
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
                            {{-- <tbody>{{$invoice}} --}}
                            <!-- Dynamically populated items -->
                            <tr>
                                <td><input type="text" class="form-control" name="item[]" value="{{$invoice->item}}"></td>
                                <td><input type="text" class="form-control" name="description[]" value="{{$invoice->description}}"></td>
                                <td><input type="number" class="form-control" name="quantity[]" value="{{$invoice->quantity}}"></td>
                                <td><input type="number" class="form-control" name="price[]" value="{{$invoice->price}}"></td>
                                <td><input type="number" class="form-control" readonly></td>
                                {{-- <td><button class="btn btn-danger" onclick="removeItem(this)"><i class="fas fa-trash-alt"></i></button></td> --}}
                            </tr>
                            </tbody>
                        </table>
                    </div>

                    <!-- Other invoice details (Subtotal, Discount, etc.) -->
                    <div class="row mt-3">
                        <div class="col-md-4">
                            <label for="subtotal" class="form-label">Subtotal</label>
                            <input type="number" class="form-control" id="subtotal" name="subtotal" readonly>
                        </div>
                        <div class="col-md-4">
                            <label for="discount" class="form-label">Discount (%)</label>
                            <input type="number" class="form-control" id="discount" name="discount">
                        </div>
                        <div class="col-md-4">
                            <label for="grandTotal" class="form-label">Grand Total</label>
                            <input type="number" class="form-control" id="grandTotal" name="grand_total" readonly>
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
        /* Ensure scaling happens from the center */
    }
    

</style>
<script>
    document.addEventListener('DOMContentLoaded', (event) => {
        // Add the animation class when the DOM is fully loaded
        document.querySelector('.card').classList.add('pop-animation');
    });

    // Show modal on button click
    function removeItem(button) {
        const row = button.closest('tr');
        row.remove();
    }

</script>

@endsection
