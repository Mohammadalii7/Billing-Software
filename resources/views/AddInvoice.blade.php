@extends('layout')

@section('title', 'Auto Relax')

@section('content')
<div class="container mt-4">
    <div class="card">
        <div class="card-header">
            <h4><i class="fas fa-file-invoice"></i> Add Invoice</h4>
        </div>

        <div class="card-body">
            <form action="AddInvoice" method="post">
                @csrf

                <div class="row mb-3">
                    <div class="col-md-6">
                        <label for="customer" class="form-label">Customer</label>
                        <input type="text" class="form-control" id="customer" name="customer" placeholder="Type at least first two characters" required>
                    </div>
                    <div class="col-md-6">
                        <label for="phone" class="form-label">Contact</label>
                        <input type="text" class="form-control" id="phone" name="phone" placeholder="Enter phone information" required>
                    </div>
                </div>

                <div class="d-flex mb-3">
                    <button class="btn btn-primary me-2" id="addItemBtn"><i class="fas fa-plus"></i> Add Custom Item</button>
                </div>

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

                <div class="accordion mt-4" id="accordionExample">
                    <div class="accordion-item">
                        <h2 class="accordion-header" id="headingOne">
                            <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                Invoice Info
                            </button>
                        </h2>

                        <div id="collapseOne" class="accordion-collapse collapse show" aria-labelledby="headingOne" data-bs-parent="#accordionExample">
                            <div class="accordion-body">
                                <div class="row">
                                    <div class="col-md-4">
                                        <label for="invoiceDate" class="form-label">Invoice Date</label>
                                        <input type="date" class="form-control" id="invoiceDate" name="invoice_date" value="{{ date('Y-m-d') }}">
                                    </div>
                                    <div class="col-md-4">
                                        <label for="dueDate" class="form-label">Due Date</label>
                                        <input type="date" class="form-control" id="dueDate" name="due_date" required>
                                    </div>
                                    <div class="col-md-4">
                                        <label for="taxNo" class="form-label">Tax No</label>
                                        <input type="text" class="form-control" id="taxNo" name="tax_no" placeholder="Tax No">
                                    </div>
                                </div>

                                <div class="row mt-3">
                                    <div class="col-md-3">
                                        <label for="subtotal" class="form-label">Subtotal</label>
                                        <input type="number" class="form-control" id="subtotal" name="subtotal" value="0" readonly>
                                    </div>
                                    <div class="col-md-3">
                                        <label for="discount" class="form-label">Discount (%)</label>
                                        <input type="number" class="form-control" id="discount" name="discount" min="0" max="100" placeholder="Discount">
                                    </div>
                                    <div class="col-md-3">
                                        <label for="discountAmount" class="form-label">Discount Amount</label>
                                        <input type="number" class="form-control" id="discountAmount" name="discount_amount" readonly>
                                    </div>
                                    <div class="col-md-3">
                                        <label for="taxableAmount" class="form-label">Taxable Amount</label>
                                        <input type="number" class="form-control" id="taxableAmount" name="taxable_amount" value="0" readonly>
                                    </div>
                                    <div class="col-md-3 mt-3">
                                        <label for="grandTotal" class="form-label">Grand Total</label>
                                        <input type="number" class="form-control" id="grandTotal" name="grand_total" readonly>
                                    </div>
                                </div>

                                {{-- <div class="mt-3">
                                    <label for="remark" class="form-label">Remark</label>
                                    <textarea class="form-control" id="remark" name="remark" rows="3"></textarea>
                                </div> --}}
                            </div>
                        </div>
                    </div>
                </div>

                <div class="d-flex justify-content-end mt-4">
                    <button type="submit" class="btn btn-success"><i class="fas fa-check-circle"></i> Generate</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    document.getElementById('addItemBtn').addEventListener('click', function(e) {
        e.preventDefault();
        addItem();
    });

    function addItem() {
        const tableBody = document.querySelector('#itemsTable tbody');
        const newRow = document.createElement('tr');

        newRow.innerHTML = `
            <td>   <select class="form-control" name="item_name[]" onchange="updatePriceAndTotal(this)">
                <option value="">Select Item</option>
                <option  data-price="10">Alignment</option>
                <option  data-price="20">Balancing</option>
                <option  data-price="30">Car Washing</option>
                <option  data-price="30">New Tyre</option>
                <option  data-price="30">Second Tyre</option>
                <option  data-price="30">Nitrogen Air</option>
                <option  data-price="30">Car Polish</option>
                <option  data-price="30">Punchar</option>
                <!-- Add more options here or load them dynamically -->
            </select></td>
            <td><input type="text" class="form-control" name="description[]" placeholder="Description"></td>
            <td><input type="number" class="form-control quantity" name="quantity[]" value="0" min="0" oninput="updateTotal(this)"></td>
            <td><input type="number" class="form-control price" name="price[]" value="0.00" min="0" step="0.01" oninput="updateTotal(this)"></td>
            <td><input type="number" class="form-control total" name="totalprice[]" value="0.00" readonly></td>
            <td><button class="btn btn-danger" type="button" onclick="removeItem(this)"><i class="fas fa-trash-alt"></i></button></td>
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
    const quantityInput = row.querySelector('.quantity');
    const priceInput = row.querySelector('.price');
    const totalInput = row.querySelector('.total');

    let quantity = parseFloat(quantityInput.value) || 0;
    let price = parseFloat(priceInput.value) || 0;

    
    let total = (quantity === 0) ? price : (quantity * price);

   
    totalInput.value = total.toFixed(2);
    updateInvoiceSummary();
}

    function updateInvoiceSummary() {
    let subtotal = 0;
    const totalFields = document.querySelectorAll('.total');

    // Calculate subtotal by summing up all item totals
    totalFields.forEach(field => {
        subtotal += parseFloat(field.value) || 0;
    });

    // Set the subtotal value
    document.getElementById('subtotal').value = subtotal.toFixed(2);

    // Get discount percentage and calculate discount amount
    const discountPercentage = parseFloat(document.getElementById('discount').value) || 0;
    const discountAmount = (subtotal * discountPercentage / 100).toFixed(2);
    document.getElementById('discountAmount').value = discountAmount;

    // Calculate taxable amount (subtotal - discount amount)
    const taxableAmount = (subtotal - discountAmount).toFixed(2);
    document.getElementById('taxableAmount').value = taxableAmount;

    // Tax percentage logic: only add tax if needed
    // If you do not want to add tax, you can remove the taxPercentage or set it to 0.
    const taxPercentage = 0; // Set this to 0 if no tax is required
    const taxAmount = (taxableAmount * taxPercentage / 100).toFixed(2);

    // Calculate grand total (taxableAmount + taxAmount, but taxAmount is zero if no tax)
    const grandTotal = parseFloat(taxableAmount).toFixed(2); // Ignore tax if not required
    document.getElementById('grandTotal').value = grandTotal;
}

// Recalculate whenever discount is changed
document.getElementById('discount').addEventListener('input', updateInvoiceSummary);

</script>

@endsection
