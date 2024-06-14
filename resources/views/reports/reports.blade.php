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

                <div class="row">
                    <div class="col-md-4">
                        <div class="card">
                            <div class="card-header">Sales Report <i class="bi bi-clipboard-data"></i></div>
                            <div class="card-body">
                                <a class="m-2 text-dark" href="">1. Admission Payment</a><br>
                                <a class="m-2 text-dark" href="">2. Monthly Fee Payment</a><br>
                                <a class="m-2 text-dark" href="">3. Student Admission Fee Payment</a><br>
                                 <a class="m-2 text-dark" href="">3. Fees By Student</a><br>
                                  <a class="m-2 text-dark" href="">3. Discount Report</a><br>
                                  <a class="m-2 text-dark" href="">3. Credit Payment Report</a><br>

                            </div>
                        </div>
                    </div>

                    <div class="col-md-4">

                        <div class="card">
                            <div class="card-header">Expenses Report</div>
                            <div class="card-body">
                                <a class="m-1 text-dark" href="">1. Daily Expenses</a><br>
                            </div>
                        </div>

                    </div>
                    <div class="col-md-4">

                        <div class="card">
                            <div class="card-header">Other Report</div>
                            <div class="card-body">
                                <a class="m-1 text-dark" href="">1. Student Admission</a><br>
                            </div>
                        </div>

                    </div>

                </div>


            </div>
        </div>













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
