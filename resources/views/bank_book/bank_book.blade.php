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

    <style>
        /* Inline CSS for card styling */
        .card {
            border: 1px solid #ccc;
            border-radius: 8px;
            padding: 10px;
            margin-bottom: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            background-color: #f9f9f9;
        }

        .card-header {
            background-color: #007bff;
            color: white;
            padding: 8px;
            border-top-left-radius: 8px;
            border-top-right-radius: 8px;
            font-weight: bold;
        }

        .card-body {
            padding: 10px;
        }

        .card-body p {
            margin: 5px 0;
        }

        .custom-gradient-background {
            background: linear-gradient(to bottom right, #3D5EE1, #9ca1ff);
            /* Adjust colors as needed */
        }
    </style>

    <div class="main-wrapper">

        @include('admin_layouts.nav')


        @include('admin_layouts.sidebar')


        <div class="page-wrapper">
            <div class="content container-fluid">

                <div class="page-header">
                    <div class="row align-items-center">
                        <div class="col">
                            <h3 class="page-title">Bank Book</h3>
                            <ul class="breadcrumb">
                                <li class="breadcrumb-item"><a href="{{ url('admin/dashboard') }}">Dashboard</a></li>
                                <li class="breadcrumb-item active">Bank Book</li>
                            </ul>
                        </div>
                    </div>
                </div>

                @if ($bankAccounts->isNotEmpty())

                    <div class="row">

                        @foreach ($bankAccounts as $data)
                            <div class="col-lg-4 col-md-4">
                                <div class="card mb-4 custom-gradient-background">
                                    <div class="card-header bg-light rounded">
                                        <h5 class="card-title text-dark mb-0">Bank: {{ $data->bank_name }}</h5>
                                    </div>
                                    <div class="card-body">
                                        <p class="card-text text-light"><strong>Account Holder Name:</strong>
                                            {{ $data->account_name }}</p>
                                        <p class="card-text text-light"><strong>Account Number:</strong>
                                            {{ $data->account_number }}</p>
                                        <p class="card-text text-light"><strong>Account Type:</strong>
                                            {{ $data->account_type }}
                                        </p>
                                        <p class="card-text text-light"><strong>Balance:</strong> Rs.
                                            {{ number_format($data->balance, 2) }}</p>


                                        <div class="row mt-3 bg-light rounded p-3">
                                            <div class="col">
                                                <div class="text-center icon-container">
                                                    <a href="{{ url('admin/bank-book/' . $data->slug . '/deposit') }}"
                                                        class="circle-button mb-1">
                                                        <i class='bx bx-up-arrow-alt bx-sm'></i>
                                                    </a>
                                                    <br>

                                                    <a href="{{ url('admin/bank-book/' . $data->slug . '/deposit') }}"
                                                        class="text-dark">Deposit</a>
                                                </div>
                                            </div>

                                            <div class="col">
                                                <div class="text-center icon-container">
                                                    <a href="{{ url('admin/bank-book/' . $data->slug . '/withdraw') }}"
                                                        class="circle-button mb-1">

                                                        <i class='bx bx-expand-horizontal bx-sm'></i>
                                                    </a>
                                                    <br>
                                                    <a href="{{ url('admin/bank-book/' . $data->slug . '/withdraw') }}"
                                                        class="text-dark">Withdraw</a>
                                                </div>
                                            </div>

                                            <div class="col">
                                                <div class="text-center icon-container">
                                                    <a href="{{ url('admin/bank-book/' . $data->slug . '/statements') }}" class="circle-button mb-1">
                                                        <i class='bx bx-down-arrow-alt bx-sm'></i>
                                                    </a>
                                                    <br>
                                                    <a href="{{ url('admin/bank-book/' . $data->slug . '/statements') }}" class="text-dark">Statement</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach

                    </div>
                @else
                    <div class="row">
                        <div class="col-md-12">
                            <div class="card"
                                style="margin-top: 20px; padding: 20px; text-align: center; background-color: #f8f9fa; border: 1px solid #dee2e6; border-radius: 5px;">
                                <h4>No bank account details found</h4>
                                <p>Please create a bank account to start adding transactions.</p>
                                <a class="btn btn-primary text-center mx-auto d-block" style="max-width: 200px"
                                    href="{{ url('admin/bank-book/create-bank-account') }}">Create Bank Account</a>
                            </div>
                        </div>
                    </div>
                @endif



            </div>
        </div>













        @include('admin_layouts.footer2')

    </div>
    <style>
        .circle-button {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            text-decoration: none;
            border-radius: 50%;
            width: 40px;
            height: 40px;
            background-color: #131722;
            color: #ffffff;
        }
    </style>


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
