<!DOCTYPE html>
<html lang="en">

@include('admin_layouts.header')
<link rel="stylesheet" href="{{ url('assets/css/fullcalendar.min.css') }}">
<script type="text/javascript" src="https://code.jquery.com/jquery-3.5.1.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>

<link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/jquery.dataTables.min.css" />
<link rel="stylesheet" href="https://cdn.datatables.net/buttons/1.7.1/css/buttons.dataTables.min.css">
<script src="https://cdn.datatables.net/buttons/1.7.1/js/dataTables.buttons.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.7.1/js/buttons.html5.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.7.1/js/buttons.print.min.js"></script>


<body>

    <div class="main-wrapper">

        @include('admin_layouts.nav')


        @include('admin_layouts.sidebar')


        <div class="page-wrapper">
            <div class="content container-fluid">


                <div class="page-header invoices-page-header">
                    <div class="row align-items-center">
                        <div class="col-auto">
                            <ul class="breadcrumb invoices-breadcrumb">
                                <li class="breadcrumb-item invoices-breadcrumb-item">
                                    <a href="{{ url('admin/accounts/student-monthly-fees-payments') }}">
                                        <i class='bx bx-arrow-back'></i> Back to Monthly Fees Payment
                                    </a>
                                </li>
                            </ul>
                        </div>

                    </div>
                </div>
                <div class="container">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="card invoices-add-card">
                                <div class="card-body">
                                    <form action="{{ url('admin/accounts/student-monthly-fees-payments') }}"
                                        class="invoices-form" method=POST>
                                        @csrf

                                        <input type="hidden" value="{{ $student->id }}" name="student_id">

                                        <input type="hidden" value="{{ $student->class_id }}" name="class_id">

                                        <div class="invoices-main-form">
                                            <div class="row">
                                                <div class="col-xl-4 col-md-6 col-sm-12 col-12">
                                                    <div class="form-group">
                                                        <label>Student Name</label>
                                                        <input class="form-control" type="text"
                                                            value="{{ $student->name }}" readonly>
                                                    </div>

                                                </div>

                                                {{-- Last Payment History --}}
                                                <div class="col-xl-4 col-md-6 col-sm-12 col-12">
                                                    <div class="form-group">
                                                        <label>Student Class</label>
                                                        <input class="form-control" type="text"
                                                            value="{{ $class->class_name }}" readonly>


                                                    </div>
                                                </div>



                                                {{-- Last Payment History --}}
                                                <div class="col-xl-4 col-md-6 col-sm-12 col-12">
                                                    <h4 class="invoice-details-title">Select Payment Month</h4>
                                                    <div class="invoice-details-box">
                                                        <select id="nepali_months" name="nepali_month"
                                                            class="form-control select">
                                                            @foreach ($nepaliMonthMap as $monthNumber => $monthName)
                                                                @unless (in_array($monthName, $paymentMonths))
                                                                    <option value="{{ $monthNumber }}">{{ $monthName }}
                                                                    </option>
                                                                @endunless
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>

                                            </div>
                                        </div>

                                        <div class="invoice-add-table mb-0">
                                            <h4 class="mt-0">Bill Details</h4>
                                            <div class="table-responsive">
                                                <table class=" table-invoice">
                                                    <thead>
                                                        <tr>
                                                            <th>ID</th>
                                                            <th>Particular Name</th>
                                                            <th>Amount</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        @php
                                                            $counter = 2;
                                                        $totalAmount = 0; @endphp
                                                        <tr>
                                                            <td>1</td>
                                                            <td>Monthly Fees</td>

                                                            <td>
                                                                <input class="form-control py-0 my-0 amount-input"
                                                                    value="{{ $student->monthly_payment_amount }}"
                                                                    name="monthly_fees" required>
                                                            </td>
                                                        </tr>
                                                        @forelse ($monthlyParticulars as $monthlyParticular)
                                                            <tr>
                                                                <td>{{ $counter }}</td>
                                                                <td>
                                                                    <p>{{ $monthlyParticular->particulars }}</p>
                                                                    <input type="hidden"
                                                                        value="{{ $monthlyParticular->particulars }}"
                                                                        name="particulars[{{ $counter }}][particular_name]" />
                                                                </td>
                                                                <td>
                                                                    <input class="form-control py-0 my-0 amount-input"
                                                                        type="number"
                                                                        value="{{ $monthlyParticular->amount }}"
                                                                        name="particulars[{{ $counter }}][particular_amount]">
                                                                </td>
                                                            </tr>
                                                            @php
                                                                $counter++;
                                                            $totalAmount += $monthlyParticular->amount; @endphp
                                                        @empty
                                                            <tr>
                                                                <td colspan="3">No particulars found</td>
                                                            </tr>
                                                        @endforelse
                                                    </tbody>
                                                </table>

                                            </div>
                                        </div>

                                        <script>
                                            document.addEventListener('DOMContentLoaded', function() {
                                                const amountInputs = document.querySelectorAll('.amount-input');
                                                const discountInput = document.getElementById('discount-input');
                                                const fineInput = document.getElementById('fine-amount');
                                                const subTotalElement = document.getElementById('sub-total-amount');
                                                const totalAmountElement = document.getElementById('total-amount');

                                                function updateSubTotal() {
                                                    let subTotal = 0;
                                                    amountInputs.forEach(input => {
                                                        subTotal += parseFloat(input.value) || 0;
                                                    });
                                                    subTotalElement.textContent = `Rs. ${subTotal.toFixed(2)}`;
                                                    updateTotal(subTotal);
                                                }

                                                function updateTotal(subTotal) {
                                                    const discount = parseFloat(discountInput.value) || 0;
                                                    const fine = parseFloat(fineInput.value) || 0;
                                                    let totalAmount = subTotal - discount + fine;
                                                    totalAmountElement.textContent = `Rs. ${totalAmount.toFixed(2)}`;
                                                }

                                                amountInputs.forEach(input => {
                                                    input.addEventListener('input', function() {
                                                        updateSubTotal();
                                                    });
                                                });

                                                discountInput.addEventListener('input', function() {
                                                    const subTotal = parseFloat(subTotalElement.textContent.replace('Rs. ', '')) || 0;
                                                    updateTotal(subTotal);
                                                });

                                                fineInput.addEventListener('input', function() {
                                                    const subTotal = parseFloat(subTotalElement.textContent.replace('Rs. ', '')) || 0;
                                                    updateTotal(subTotal);
                                                });

                                                // Initial calculation
                                                updateSubTotal();
                                            });
                                        </script>

                                        <div class="row">
                                            <div class="col-lg-7 col-md-6">
                                            </div>

                                            <div class="col-lg-5 col-md-6">
                                                <div class="invoice-total-card">
                                                    <h4 class="invoice-total-title">Summary</h4>
                                                    <div class="invoice-total-box">
                                                        <div class="invoice-total-inner">
                                                            <p class="sub-total"
                                                                style="font-family: Arial, sans-serif; font-size: 16px;">
                                                                Sub-Total Amount: <span id="sub-total-amount">Rs.
                                                                    0.00</span></p>

                                                            <input type="hidden" name="sub_total"
                                                                id="sub-total-amount-input" value="0.00">


                                                            

                                                            <div class="links-info-discount mt-2"
                                                                id="credit-amount-field"
                                                                style="display: flex; align-items: center;">
                                                                <p for="discount-input"
                                                                    style="margin-right: 10px; margin-bottom: 0; font-family: Arial, sans-serif; font-size: 16px; flex-shrink: 0;">
                                                                    Credit:
                                                                </p>
                                                                <input type="number" id="credit-amount"
                                                                    class="form-control"
                                                                    style="height: 40px; flex-grow: 1;"
                                                                    name="credit_amount" readonly>
                                                            </div>
                                              
                                                        </div>

                                                        <div class="invoice-total-footer">
                                                            <h5
                                                                style="font-family: Arial, sans-serif; font-size: 16px;">
                                                                Total Amount: <span id="total-amount"
                                                                    style="font-family: Arial, sans-serif; font-size: 16px;">Rs.
                                                                    0.00</span></h5>
                                                            <input type="hidden" name="net_total"
                                                                id="total-amount-input" value="0.00">


                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="upload-sign">


                                                    <div class="form-group float-end mb-0">
                                                        <button class="btn btn-primary" type="submit">Save
                                                            Invoice</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <style>
            .table-invoice {
                width: 100%;
                border-collapse: collapse;
                margin: 0;
                padding: 0;
            }

            .table-invoice th,
            .table-invoice td {
                border: 1px solid #ddd;
                margin: 0;
                padding: 3px;
            }

            .table-invoice th {
                background-color: #f2f2f2;
                text-align: center;
            }

            .table-invoice td {
                text-align: center;
            }

            .table-invoice tbody tr:nth-child(even) {
                background-color: #f9f9f9;
            }

            .table-invoice tbody tr:hover {
                background-color: #f1f1f1;
            }

            .table-invoice p {
                margin: 0;
                padding: 0;
            }
        </style>

        <script>
            document.addEventListener("DOMContentLoaded", function() {
                var paidInput = document.getElementById("paid-input");
                var creditAmountField = document.getElementById("credit-amount");
                var totalAmountInput = document.getElementById("total-amount-input");

                if (paidInput && creditAmountField && totalAmountInput) {
                    paidInput.addEventListener("input", function() {
                        var paidAmount = parseFloat(paidInput.value) || 0;
                        var totalAmount = parseFloat(totalAmountInput.value) || 0;

                        var creditAmount = totalAmount - paidAmount;

                        if (paidAmount >= totalAmount) {
                            creditAmount = 0;
                        }

                        creditAmountField.value = creditAmount.toFixed(2);
                    });
                }
            });
        </script>


        <script>
            // Get the elements
            const paidInput = document.getElementById('paid-input');
            const returnInput = document.getElementById('return-input');
            const netTotalInput = document.getElementById('total-amount-input');

            // Add event listener to the paid input field
            paidInput.addEventListener('input', function() {
                // Get the paid amount
                const paidAmount = parseFloat(this.value);

                // Get the net total
                const netTotal = parseFloat(netTotalInput.value);

                // Calculate the return amount
                const returnAmount = paidAmount > netTotal ? (paidAmount - netTotal) : 0;

                // Update the return amount input field
                returnInput.value = returnAmount.toFixed(2);
            });
        </script>

        <script>
            function updateSubTotalAmount() {
                var subTotalAmountText = document.getElementById('sub-total-amount').textContent;
                var subTotalAmountValue = subTotalAmountText.replace('Rs.', '').trim();
                document.getElementById('sub-total-amount-input').value = subTotalAmountValue;
            }

            function updateTotalAmount() {
                var totalAmountText = document.getElementById('total-amount').textContent;
                var totalAmountValue = totalAmountText.replace('Rs.', '').trim();
                document.getElementById('total-amount-input').value = totalAmountValue;
            }

            document.getElementById('sub-total-amount').textContent = 'Rs. 100.00';
            document.getElementById('total-amount').textContent = 'Rs. 120.00';
            updateSubTotalAmount();
            updateTotalAmount();

            document.getElementById('sub-total-amount').addEventListener('DOMSubtreeModified', updateSubTotalAmount);
            document.getElementById('total-amount').addEventListener('DOMSubtreeModified', updateTotalAmount);
        </script>


        @include('admin_layouts.footer2')

    </div>

    <script src="{{ url('assets/js/moment.min.js') }}"></script>
    <script src="{{ url('assets/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ url('assets/js/bootstrap-datetimepicker.min.js') }}"></script>
    <script src="{{ url('assets/js/feather.min.js') }}"></script>
    <script src="{{ url('assets/js/jquery.slimscroll.min.js') }}"></script>
    <script src="{{ url('assets/js/script.js') }}"></script>
    <script src="{{ url('assets/js/select2.min.js') }}"></script>
    <script src="{{ url('assets/js/filepond.js') }}"></script>
    <script src="{{ url('assets/js/apexcharts.min.js') }}"></script>
    <script src="{{ url('assets/js/chart-data.js') }}"></script>


</body>

</html>
