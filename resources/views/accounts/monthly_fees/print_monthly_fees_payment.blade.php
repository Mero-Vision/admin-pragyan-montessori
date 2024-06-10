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

                <div class="row ">
                    <div class="col-md-6 mx-auto d-block border px-5 py-4 rounded">
                        <form action="{{ url('admin/accounts/student-monthly-fees-payments/print/' . $slug) }}"
                            method="get">
                            <div class="input-group">
                                <select name="payment_month" class="form-control form-select">
                                    @foreach ($paymentMonths as $paymentMonth)
                                        <option value="{{ $paymentMonth->month }}">{{ $paymentMonth->month }}
                                        </option>
                                    @endforeach
                                </select>
                                <button type="submit" class="input-group-text btn btn-primary"><i
                                        class="bi bi-search mx-2"></i> Print</button>
                            </div>
                        </form>


                    </div>
                </div>

                @if ($monthlyPayments)
                 <button onclick="printDivContent()" class="btn btn-primary m-2 text-center mx-auto d-block">Print Invoice</button>
                    <div id="contentDiv"
                        style="font-family: Arial, sans-serif; margin: 0; padding: 20px; background-color: #f4f4f4;" class="m-3">
                        <div
                            style="max-width: 600px; margin: auto; background: white; padding: 20px; border: 1px solid #ddd;">
                            <header style="text-align: center; margin-bottom: 20px;">
                                <h3 style="margin: 0; color: #333;">Pragyan Montessori & Childcare, PMC </h3>
                                <p style="margin: 0; color: #666;">Address: New Naikap, Pragati Sangam Marg</p>
                                <p style="margin: 0; color: #666;">Phone: 9810212323 | Email:
                                    support@pragyanmontessori.com</p>
                            </header>

                            <section style="margin-bottom: 20px;">
                                <h2
                                    style="margin: 0; color: #333; border-bottom: 2px solid #333; padding-bottom: 10px;">
                                    Invoice</h2>
                                {{-- <p style="margin: 5px 0; color: #666;">Invoice Number: <strong>#123456</strong></p> --}}
                                <p style="margin: 5px 0; color: #666;">Invoice Date:
                                    <strong>{{ \Carbon\Carbon::parse($monthlyPayments->created_at)->format('M d, Y h:i a') }}</strong>
                                </p>
                                <p style="margin: 5px 0; color: #666;">
                                    Monthly Payments for: <strong>{{ $monthlyPayments->month }}</strong>
                                </p>

                            </section>

                            <section style="margin-bottom: 20px;">
                                <h3 style="margin: 0; color: #333; border-bottom: 1px solid #ddd; padding-bottom: 5px;">
                                    Billing To:</h3>
                                <p style="margin: 5px 0; color: #666;">Parent/Guardian Name:
                                    {{ $student->guardian_name }}</p>
                                <p style="margin: 5px 0; color: #666;">Address: {{ $student->address }}</p>
                                <p style="margin: 5px 0; color: #666;">Phone: {{ $student->mobile_no }}</p>
                            </section>

                            <section style="margin-bottom: 20px;">
                                <h3 style="margin: 0; color: #333; border-bottom: 1px solid #ddd; padding-bottom: 5px;">
                                    Student Details:</h3>
                                <p style="margin: 5px 0; color: #666;">Student Name:
                                    <strong>{{ $student->name }}</strong>
                                </p>
                                <p style="margin: 5px 0; color: #666;">Class: <strong>{{ $class->class_name }}</strong>
                                </p>
                            </section>

                            <table style="width: 100%; border-collapse: collapse; margin-bottom: 20px;">
                                <thead>
                                    <tr style="background-color: #f9f9f9;">
                                        <th style="border: 1px solid #ddd; padding: 8px; text-align: left;">Description
                                        </th>
                                        <th style="border: 1px solid #ddd; padding: 8px; text-align: right;">Amount</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php
                                        $totalAmount = 0;
                                    @endphp
                                    @foreach ($monthFeesPaymentDetails as $monthFeesPaymentDetail)
                                        @php
                                            $totalAmount += $monthFeesPaymentDetail->amount;
                                        @endphp
                                        <tr>
                                            <td style="border: 1px solid #ddd; padding: 8px;">
                                                {{ $monthFeesPaymentDetail->particulars }}</td>
                                            <td style="border: 1px solid #ddd; padding: 8px; text-align: right;">
                                                {{ $monthFeesPaymentDetail->amount }}
                                            </td>
                                        </tr>
                                    @endforeach
                                    <tr>
                                        <td style="border: 1px solid #ddd; padding: 8px;"><strong>Total</strong></td>
                                        <td style="border: 1px solid #ddd; padding: 8px; text-align: right;">
                                            <strong>Rs. {{ $totalAmount }}</strong>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>

                            <section>
                                <h3 style="margin: 0; color: #333; border-bottom: 1px solid #ddd; padding-bottom: 5px;">
                                    Payment Instructions:</h3>
                                <p style="margin: 5px 0; color: #666;">Please make the payment by the due date to avoid
                                    any
                                    late fees.</p>
                                {{-- <p style="margin: 5px 0; color: #666;"><strong>Due Date: June 30, 2024</strong></p> --}}
                            </section>

                            <footer style="text-align: center; margin-top: 20px;">
                                <p style="margin: 0; color: #666;">Thank you for your prompt payment.</p>
                                <p style="margin: 0; color: #666;">If you have any questions, please contact the school
                                    office.</p>
                            </footer>
                        </div>
                    </div>
                   
                @endif






            </div>
        </div>




        <script>
            function printDivContent() {
                printJS({
                    printable: 'contentDiv',
                    type: 'html',
                    scanStyles: true,
                    style: `
                body {
                    font-family: Arial, sans-serif;
                    margin: 0;
                    padding: 20px;
                    background-color: #f4f4f4;
                }
                table {
                    width: 100%;
                    border-collapse: collapse;
                }
                td {
                    border: 1px solid #ddd;
                    padding: 8px;
                    text-align: left;
                }
                td:last-child {
                    text-align: right;
                }
            `
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
    <script src="https://printjs-4de6.kxcdn.com/print.min.js"></script>
    <link rel="stylesheet" href="https://printjs-4de6.kxcdn.com/print.min.css">

</body>

</html>
