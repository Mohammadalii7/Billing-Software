@extends('layout')

@section('title', 'Add Invoice')

@section('content')
<div class="container mt-4">
    <div class="card">
        <div class="card-header">
            <h4><i class="fas fa-file-invoice"></i> Add Invoice</h4>
        </div>

        <div class="card-body">
            <!-- Form Starts -->
            <form action="add" method="post">
                @csrf <!-- CSRF protection for Laravel -->

                <!-- Customer Input -->
                <div class="mb-3">
                    <label for="subscriber" class="form-label">Customer</label>
                    <input type="text" class="form-control" id="customer" name="customer"   placeholder="Type at least first two characters">
                </div>

                <!-- Add Item Button -->
                <div class="d-flex mb-3">
                    <button class="btn btn-primary me-2" id="addItemBtn"><i class="fas fa-plus"></i> Add Custom Item</button>
                </div>

                <!-- Responsive Items Table -->
                <div class="table-responsive">
                    <table class="table table-bordered" id="itemsTable">
                        <thead class="table-light">
                            <tr>
                                <th>Item</th>
                                <th>Description</th>
                                <th>Quantity</th>
                                <th>Price</th>
                                <th>Total</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <!-- Items will be dynamically added here -->
                        </tbody>
                    </table>
                </div>

                <!-- Accordion for Additional Invoice Info -->
                <div class="accordion" id="accordionExample">
                    <div class="accordion-item">
                        <h2 class="accordion-header" id="headingOne">
                            <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                Invoice Info
                            </button>
                        </h2>

                        <div id="collapseOne" class="accordion-collapse collapse show" aria-labelledby="headingOne" data-bs-parent="#accordionExample">
                            <div class="accordion-body">
                                <!-- Invoice Date, Due Date, Tax No -->
                                <div class="row">
                                    <div class="col-sm-12 col-md-4">
                                        <label for="invoiceDate" class="form-label">Invoice Date</label>
                                        <input type="date" class="form-control" id="invoiceDate" name="invoice_date" value="{{ date('Y-m-d') }}">
                                    </div>
                                    <div class="col-sm-12 col-md-4">
                                        <label for="dueDate" class="form-label">Due Date</label>
                                        <input type="date" class="form-control" id="dueDate" name="due_date">
                                    </div>
                                    <div class="col-sm-12 col-md-4">
                                        <label for="taxNo" class="form-label">Tax No</label>
                                        <input type="text" class="form-control" id="taxNo" name="tax_no" placeholder="Tax No">
                                    </div>
                                </div>

                                <!-- Subtotal, Discount, Taxable Amount, Grand Total -->
                                <div class="row mt-3">
                                    <div class="col-sm-12 col-md-3">
                                        <label for="subtotal" class="form-label">Subtotal</label>
                                        <input type="number" class="form-control" id="subtotal" name="subtotal" value="0" readonly>
                                    </div>
                                    <div class="col-sm-12 col-md-3">
                                        <label for="discount" class="form-label">Discount (%)</label>
                                        <input type="number" class="form-control" id="discount" name="discount" placeholder="Discount">
                                    </div>
                                    <div class="col-sm-12 col-md-3">
                                        <label for="discountAmount" class="form-label">Discount Amount</label>
                                        <input type="number" class="form-control" id="discountAmount" name="discount_amount" readonly>
                                    </div>
                                    <div class="col-sm-12 col-md-3">
                                        <label for="taxableAmount" class="form-label">Taxable Amount</label>
                                        <input type="number" class="form-control" id="taxableAmount" name="taxable_amount" value="0" readonly>
                                    </div>
                                    <div class="col-sm-12 col-md-3 mt-3">
                                        <label for="grandTotal" class="form-label">Grand Total</label>
                                        <input type="number" class="form-control" id="grandTotal" name="grand_total"  readonly>
                                    </div>
                                </div>

                                <!-- Remark -->
                                <div class="mt-3">
                                    <label for="remark" class="form-label">Remark</label>
                                    <textarea class="form-control" id="remark" name="remark" rows="3"></textarea>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Footer Buttons -->
                <div class="d-flex justify-content-end mt-4">
                    <button type="submit" class="btn btn-success"><i class="fas fa-check-circle"></i> Generate</button>
                </div>
            </form>
            <!-- Form Ends -->
        </div>
    </div>
</div>


<script>
    document.getElementById('addItemBtn').addEventListener('click', function(e) {
        e.preventDefault()
        addItem();
    });

    function addItem() {
        const tableBody = document.querySelector('#itemsTable tbody');
        const newRow = document.createElement('tr');
        
        newRow.innerHTML = `
            <td><input type="text" class="form-control" name="item" placeholder="Item Name"></td>
            <td><input type="text" class="form-control" placeholder="Description"></td>
            <td><input type="number" class="form-control quantity" value="1" min="1" oninput="updateTotal(this)"></td>
            <td><input type="number" class="form-control price" value="0.00" min="0" step="0.01" oninput="updateTotal(this)"></td>
            <td><input type="number" class="form-control total" value="0.00" readonly></td>
            <td><button class="btn btn-danger" onclick="removeItem(this)"><i class="fas fa-trash-alt"></i></button></td>
        `;
        
        tableBody.appendChild(newRow);
    }

    function removeItem(button) {
        const row = button.closest('tr');
        row.remove();
        updateInvoiceSummary();
    }

    function updateTotal(input) {
        const row = input.closest('tr');
        const quantity = row.querySelector('.quantity').value;
        const price = row.querySelector('.price').value;
        const total = row.querySelector('.total');
        
        total.value = (quantity * price).toFixed(2);
        updateInvoiceSummary();
    }

    function updateInvoiceSummary() {
        let subtotal = 0;
        const totalFields = document.querySelectorAll('.total');
        totalFields.forEach(field => {
            subtotal += parseFloat(field.value);
        });

        // Update Subtotal
        document.getElementById('subtotal').value = subtotal.toFixed(2);

        // Get Discount Percentage
        const discountPercentage = document.getElementById('discount').value || 0;
        const discountAmount = (subtotal * discountPercentage / 100).toFixed(2);
        document.getElementById('discountAmount').value = discountAmount;

        // Calculate Taxable Amount after Discount
        const taxableAmount = (subtotal - discountAmount).toFixed(2);
        document.getElementById('taxableAmount').value = taxableAmount;

        // Apply Tax Percentage (if any)
        const taxPercentage = 10; // Example of 10% tax rate
        const taxAmount = (taxableAmount * taxPercentage / 100).toFixed(2);

        // Update Grand Total
        const grandTotal = (parseFloat(taxableAmount) + parseFloat(taxAmount)).toFixed(2);
        document.getElementById('grandTotal').value = grandTotal;
    }

    document.getElementById('discount').addEventListener('input', updateInvoiceSummary);
</script>

@endsection
