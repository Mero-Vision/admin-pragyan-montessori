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

<style>
    .card {
        margin: 20px;
        padding: 20px;
        border: 1px solid #ccc;


    }

    @media print {
        .hide-on-print {
            display: none;
        }
    }
</style>
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script src="https://cdn.rawgit.com/jasonday/printThis/v1.15.0/printThis.js"></script>

<body>

    <div class="main-wrapper">

        @include('admin_layouts.nav')


        @include('admin_layouts.sidebar')




        <div class="page-wrapper">
            <div class="content container-fluid">
                <div class="row justify-content-center">
                    <div class="col-xl-10">


                        <div id="invoiceContent" class="card invoice-info-card">
                            <div class="card-body">
                                <div class="invoice-item invoice-item-one">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="invoice-log">
                                                <img src="{{ url('assets/img/logo.png') }}" alt="logo"
                                                    style="width:150px;">
                                            </div>
                                            <br>
                                            <div class="invoice-head2">
                                                <h5>ADMISSION INVOICE</h5>
                                                <p>ADMISSION ID : {{ $student->admission_id }}</p>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="invoice-info">
                                                <strong class="customer-text-one">Pragyan Montessori & Childcare, PMC
                                                </strong>
                                                <p class="invoice-details">
                                                    9810212323 <br>
                                                    New Naikap, Pragati Sangam Marg,<br>
                                                    Chandragiri 14, Kathmandu
                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="invoice-item invoice-item-two">
                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="invoice-info">
                                                <strong class="customer-text-one">Billed to</strong>
                                                <h6 class="invoice-name">{{ $student->name }}</h6>
                                                <p class="invoice-details invoice-details-two">
                                                    Mobile No: {{ $student->mobile_no ?? '-' }} <br>
                                                    Email: {{ $student->email ?? '-' }} <br>
                                                    Address: {{ $student->address ?? '-' }} <br>

                                                </p>
                                            </div>
                                        </div>
                                        <div class="col-md-8">
                                            <div class="invoice-info invoice-info2">
                                                <strong class="customer-text-one">Payment Details</strong>
                                                <p class="invoice-details font-weight-bold">
                                                   Payment Mode:  {{$paymentOption->payment_name}} <br>
                                                    Payment Status:  Paid <br>
                                                   
                                                </p>
                                                {{-- <div class="invoice-item-box">
                                                    <p>Payment Mode : {{ $paymentOption->payment_name }}</p>
                                                    <p class="mb-0">Payment Mode: Paid</p>
                                                </div> --}}
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="invoice-item invoice-table-wrap">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="table-responsive">
                                                <table class="invoice-tables">
                                                    <colgroup>
                                                        <col style="width: 33.33%;">
                                                        <col style="width: 33.33%;">
                                                        <col style="width: 33.33%;">
                                                    </colgroup>
                                                    <thead>
                                                        <tr>
                                                            <th class="text-center">ID</th>
                                                            <th class="text-center">Particulars</th>
                                                            <th class="text-center">Amount</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        @php
                                                            $counter = 1;
                                                        $totalAmount = 0; @endphp
                                                        @foreach ($admissionPaymentDetails as $admissionPaymentDetail)
                                                            <tr>
                                                                <td>{{ $counter }}</td>
                                                                <td>{{ $admissionPaymentDetail->particulars }}</td>
                                                                <td class="text-end">
                                                                    @if ($admissionPaymentDetail->amount !== null)
                                                                        Rs. {{ $admissionPaymentDetail->amount }}
                                                                    @endif
                                                                </td>

                                                            </tr>
                                                            @php
                                                                $counter++;
                                                            @endphp
                                                        @endforeach


                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="row align-items-center justify-content-center">
                                    <div class="col-lg-6 col-md-6">
                                        {{-- <div class="invoice-terms">
                                            <h6>Notes:</h6>
                                            <p class="mb-0">Enter customer notes or any other details</p>
                                        </div> --}}
                                        <div class="invoice-terms"
                                            style="font-family: Arial, sans-serif; font-size: 16px; color: #000;">
                                            <p class="mb-0" style="font-weight: bold;">Contact Information:</p>
                                            <p style="font-weight: normal;">For questions or concerns regarding your
                                                admission bill, please contact <span
                                                    style="font-weight: bold;">9810212323</span>.</p>
                                        </div>

                                    </div>
                                    <div class="col-lg-6 col-md-6">
                                        <div class="invoice-total-card">
                                            <div class="invoice-total-box">
                                                <div class="invoice-total-inner">
                                                    <p>Sub Total <span>Rs. {{ $admission->sub_total }}</span></p>
                                                    <p class="mb-0">Discount Amount <span>Rs.
                                                            {{ $admission->discount_amount }}</span></p>
                                                </div>
                                                <div class="invoice-total-footer">
                                                    <h4>Total Amount <span>Rs. {{ $admission->net_total }}</span></h4>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                {{-- <div class="invoice-sign text-end">
                                    <img class="img-fluid d-inline-block" src="assets/img/signature.png" alt="sign">
                                    <span class="d-block">Pragyani</span>
                                </div> --}}
                            </div>

                        </div>
                        <button class="btn btn-primary mb-3 text-center hide-on-print" onclick="printInvoice()">Print
                            Invoice</button>



                    </div>

                </div>

            </div>
        </div>





        <style>
            .invoice-tables {
                width: 100%;
                border-collapse: collapse;
                font-family: Arial, sans-serif;
                font-size: 14px;
            }

            .invoice-tables th,
            .invoice-tables td {
                border: 1px solid #ddd;
                padding: 8px;
                text-align: left;
                vertical-align: middle;
            }

            .invoice-tables th {
                background-color: #f2f2f2;
                font-weight: bold;
                text-align: center;
            }

            .invoice-tables th,
            .invoice-tables td.text-end {
                text-align: right;
            }

            .invoice-tables tbody tr:nth-child(even) {
                background-color: #f9f9f9;
            }

            .invoice-tables tbody tr:hover {
                background-color: #f1f1f1;
            }

            /* Responsive Table Styling */
            @media (max-width: 767px) {
                .invoice-tables {
                    font-size: 12px;
                }
            }
        </style>

        <script>
            function printInvoice() {
                $('#invoiceContent').printThis({
                    importCSS: true, // import parent page css
                    importStyle: true, // import style tags
                    loadCSS: [
                        'https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css'
                    ],
                    pageTitle: "Invoice", // title of the document
                    removeInline: false,

                });
            }
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
