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
<script src="
https://cdn.jsdelivr.net/npm/number-to-words@1.2.4/numberToWords.min.js
"></script>



<body>

    <div class="main-wrapper">

        @include('admin_layouts.nav')


        @include('admin_layouts.sidebar')

        <style>
            @import url('https://fonts.googleapis.com/css2?family=Kalimati&display=swap');

            body {
                font-family: 'Kalimati', Arial, sans-serif;
                background-color: #f4f4f4;
                margin: 0;
                padding: 20px;
            }

            .invoice-container {
                max-width: 800px;
                margin: auto;
                background: white;
                padding: 20px;
                border: 1px solid #ddd;
            }

            .school-info {
                text-align: center;
                margin-bottom: 20px;
            }

            .school-info h1 {
                margin: 0;
                color: #333;
                font-size: 24px;
            }

            .school-info p {
                margin: 0;
                color: #666;
            }

            .bill-info {
                text-align: left;
                margin-bottom: 20px;
            }

            .bill-info p {
                margin: 5px 0;
                color: #666;
            }

            .bill-info strong {
                color: #333;
            }

            table {
                width: 100%;
                border-collapse: collapse;
                margin-bottom: 20px;
                font-family: 'Kalimati', Arial, sans-serif;
                font-size: 14px;
            }

            table th,
            table td {
                border: 1px solid #ddd;
                padding: 8px;
                text-align: left;
            }

            table th {
                background-color: #f9f9f9;
                text-align: left;
            }

            .total-row {
                font-weight: bold;
            }

            .footer {
                text-align: center;
                margin-top: 20px;
            }

            .footer p {
                margin: 0;
                color: #666;
            }

            .print-button {
                display: flex;
                justify-content: center;
                margin-bottom: 20px;
            }
        </style>


        <div class="page-wrapper">
            <div class="content container-fluid">
                <button onclick="printDivContent()" class="btn btn-primary m-2 text-center mx-auto d-block">PRINT
                    INVOICE</button>

                <div class="invoice-container" id="contentDiv">
                    <div class="school-info">
                        <h1>PRAGYAN MONTESSORI & CHILDCARE, PMC</h1>
                        <p>Address: New Naikap, Pragati Sangam Marg</p>
                        <p>Mob: 9810212323</p>
                        <p>Email: support@pragyanmontessori.com</p>
                        <p>PAN No.: 617641304</p>
                    </div>

                    <div class="bill-info">
                        {{-- <p><strong>Bill No.:</strong> C 2118</p> --}}
                        <p><strong>Date:</strong>
                            {{ strtoupper(\Carbon\Carbon::parse($monthlyPayments->created_at)->format('M d, Y')) }}
                        </p>
                        <p><strong>Name:</strong> {{ strtoupper($student->name) }}</p>
                        <p><strong>Class:</strong> {{ strtoupper($class->class_name) }}</p>
                        <p><strong>Month of:</strong> {{ strtoupper($monthlyPayments->month) }}
                            {{ $monthlyPayments->session_year }}</p>
                    </div>
                    <table>
                        <thead>
                            <tr>
                                <th>S.N.</th>
                                <th>FEE DESCRIPTION</th>
                                <th>AMOUNT (Rs.)</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php
                                $counter = 1;
                            $totalAmount = 0; @endphp

                            @foreach ($monthFeesPaymentDetails as $monthFeesPaymentDetail)
                                <tr>
                                    <td>{{ $counter }}</td>
                                    <td>{{ $monthFeesPaymentDetail->particulars }}</td>
                                    <td>{{ $monthFeesPaymentDetail->amount }}</td>
                                </tr>
                                @php
                                    $counter++;
                                $totalAmount += $monthFeesPaymentDetail->amount; @endphp
                            @endforeach

                            <tr class="total-row">
                                <td colspan="2">Total</td>
                                <td id="total-amount">Rs. {{ $totalAmount }}</td>
                            </tr>
                        </tbody>
                    </table>

                    <div class="details">
                        <p class="m-0"><strong>This Month's Amount:</strong> {{ $totalAmount }}</p>
                        <p class="m-0"><strong>Previous Due:</strong> {{ $monthlyPayments->due_amount ?? 'Nil' }}
                        </p>
                        <p class="m-0"><strong>Grand Total:</strong> {{ $monthlyPayments->net_total}}</p>
                    </div>

                    <div class="footer">
                        <p id="amount-in-words">Rupees: <span id="amount-text"></span> rupees only</p>
                        <p>Thank you for your prompt payment.</p>
                        <p>If you have any questions, please contact the school office.</p>
                    </div>
                </div>

            </div>
        </div>

        <script>
            // Replace with your actual amount if not using Blade syntax
            const totalAmount = {{ $totalAmount }};
            const amountInWords = numberToWords.toWords(totalAmount);
            document.getElementById('amount-text').innerText = amountInWords.charAt(0).toUpperCase() + amountInWords.slice(1);
        </script>



        <script>
            function printDivContent() {
                printJS({
                    printable: 'contentDiv',
                    type: 'html',
                    scanStyles: true,
                    style: `
                body {
                font-family: 'Kalimati', Arial, sans-serif;
                background-color: #f4f4f4;
                margin: 0;
                padding: 20px;
            }

            .invoice-container {
                max-width: 800px;
                margin: auto;
                background: white;
                padding: 20px;
                border: 1px solid #ddd;
            }

            .school-info {
                text-align: center;
                margin-bottom: 20px;
            }

            .school-info h1 {
                margin: 0;
                color: #333;
                font-size: 24px;
            }

            .school-info p {
                margin: 0;
                color: #666;
            }

            .bill-info {
                text-align: left;
                margin-bottom: 20px;
            }

            .bill-info p {
                margin: 5px 0;
                color: #666;
            }

            .bill-info strong {
                color: #333;
            }

            table {
                width: 100%;
                border-collapse: collapse;
                margin-bottom: 20px;
                font-family: 'Kalimati', Arial, sans-serif;
                font-size: 14px;
            }

            table th,
            table td {
                border: 1px solid #ddd;
                padding: 8px;
                text-align: left;
            }

            table th {
                background-color: #f9f9f9;
                text-align: left;
            }

            .total-row {
                font-weight: bold;
            }

            .footer {
                text-align: center;
                margin-top: 20px;
            }

            .footer p {
                margin: 0;
                color: #666;
            }

            .print-button {
                display: flex;
                justify-content: center;
                margin-bottom: 20px;
            }
            `
                });
            }
        </script>
        <br>



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
