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
                                    <a href="{{ url('admin/accounts/admission') }}">
                                        <i class='bx bx-arrow-back'></i> Back to Admission List
                                    </a>
                                </li>
                            </ul>
                        </div>

                    </div>
                </div>

                <div class="row">
                    <div class="col-md-12">
                        <div class="card invoices-add-card">
                            <div class="card-body">
                                <form action="{{ url('admin/accounts/admission/admission-payment') }}"
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
                                                <div class="form-group">
                                                    <label>Admission ID</label>
                                                    <input class="form-control" type="text"
                                                        value="{{ $student->admission_id }}" readonly>
                                                </div>
                                            </div>
                                            <div class="col-xl-8 col-md-6 col-sm-12 col-12">
                                                <h4 class="invoice-details-title">Admission details</h4>
                                                <div class="invoice-details-box">
                                                    <div class="invoice-inner-head">
                                                        <span style="display: inline-flex; align-items: center;">
                                                            Enrollment Date: <p style="margin: 0 0 0 10px; padding: 0;">
                                                                {{ $englishDate }}</p>
                                                        </span>


                                                    </div>
                                                    <div class="invoice-inner-footer">
                                                        <div class="row align-items-center">
                                                            <div class="col-lg-6 col-md-6">
                                                                <div class="invoice-inner-date">
                                                                    <span
                                                                        style="display: inline-block; margin-right: 5px;">Student
                                                                        Class:</span>
                                                                    <span
                                                                        style="display: inline-block;">{{ $class->class_name }}</span>
                                                                </div>

                                                            </div>
                                                            <div class="col-lg-6 col-md-6">
                                                                <div class="invoice-inner-date">
                                                                    <span
                                                                        style="display: inline-block; margin-right: 5px;">Billing
                                                                        Status:</span>
                                                                    <span style="display: inline-block;">Pending</span>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                        </div>
                                    </div>

                                    <div class="invoice-add-table">
                                        <h4>Bill Details</h4>
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
                                                        $counter = 1;
                                                    $totalAmount = 0; @endphp
                                                    @forelse ($admissionParticulars as $admissionParticular)
                                                        <tr>
                                                            <td>{{ $counter }}</td>
                                                            <td>
                                                                <p>{{ $admissionParticular->particulars }}</p>
                                                                <input type="hidden"
                                                                    value="{{ $admissionParticular->particulars }}"
                                                                    name="particulars[{{ $counter }}][particular_name]" />
                                                            </td>
                                                            <td>
                                                                <input class="form-control py-0 my-0 amount-input"
                                                                    value="{{ $admissionParticular->amount }}"
                                                                    name="particulars[{{ $counter }}][particular_amount]">
                                                            </td>
                                                        </tr>
                                                        @php
                                                            $counter++;
                                                        $totalAmount += $admissionParticular->amount; @endphp
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
                                            const subTotalElement = document.getElementById('sub-total-amount');
                                            const totalAmountElement = document.getElementById('total-amount');

                                            function updateTotal() {
                                                let totalAmount = 0;
                                                amountInputs.forEach(input => {
                                                    totalAmount += parseFloat(input.value) || 0;
                                                });
                                                const discount = parseFloat(discountInput.value) || 0;
                                                totalAmount -= discount;
                                                totalAmountElement.textContent = `Rs. ${totalAmount.toFixed(2)}`;
                                            }

                                            function updateSubTotal() {
                                                let totalAmount = 0;
                                                amountInputs.forEach(input => {
                                                    totalAmount += parseFloat(input.value) || 0;
                                                });
                                                subTotalElement.textContent = `Rs. ${totalAmount.toFixed(2)}`;
                                                updateTotal();
                                            }

                                            amountInputs.forEach(input => {
                                                input.addEventListener('input', function() {
                                                    updateSubTotal();
                                                });
                                            });

                                            discountInput.addEventListener('input', function() {
                                                updateTotal();

                                            });

                                            // Initial calculation
                                            updateSubTotal();
                                        });
                                    </script>
                                    <div class="row">
                                        <div class="col-lg-7 col-md-6">
                                            <div class="invoice-fields">
                                                <h4 class="field-title">More Fields</h4>
                                                <div class="field-box">
                                                    <label class="bg-primary text-light px-2">Payment Details</label>
                                                    @forelse ($paymentOptions as $paymentOption)
                                                        <div class="radio">
                                                            <label>
                                                                <input type="radio" name="payment_option_id"
                                                                    value="{{ $paymentOption->id }}">
                                                                {{ $paymentOption->payment_name }}
                                                            </label>
                                                        </div>


                                                    @empty
                                                    @endforelse
                                                    @error('payment_option_id')
                                                        <p class="text-danger">{{ $message }}</p>
                                                    @enderror

                                                </div>
                                            </div>
                                            <div class="invoice-faq">
                                                <div class="panel-group" id="accordion" role="tablist"
                                                    aria-multiselectable="true">

                                                    <div class="faq-tab">
                                                        <div class="panel panel-default">
                                                            <div class="panel-heading" role="tab" id="headingThree">
                                                                <p class="panel-title">
                                                                    <a class="collapsed" data-bs-toggle="collapse"
                                                                        data-bs-parent="#accordion"
                                                                        href="#collapseThree" aria-expanded="false"
                                                                        aria-controls="collapseThree">
                                                                        <i class="fas fa-plus-circle me-1"></i> Add
                                                                        Notes
                                                                    </a>
                                                                </p>
                                                            </div>
                                                            <div id="collapseThree" class="panel-collapse collapse"
                                                                role="tabpanel" aria-labelledby="headingThree"
                                                                data-bs-parent="#accordion">
                                                                <div class="panel-body">
                                                                    <textarea class="form-control" name="note"></textarea>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
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


                                                        <div class="links-info-discount"
                                                            style="display: flex; align-items: center;">
                                                            <p for="discount-input"
                                                                style="margin-right: 10px; margin-bottom: 0; font-family: Arial, sans-serif; font-size: 16px;">
                                                                Discount:
                                                            </p>
                                                            <input id="discount-input" class="form-control"
                                                                type="text" style="height: 40px;"
                                                                name="discount_amount">
                                                        </div>

                                                    </div>
                                                    <div class="invoice-total-footer">
                                                        <h5 style="font-family: Arial, sans-serif; font-size: 16px;">
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