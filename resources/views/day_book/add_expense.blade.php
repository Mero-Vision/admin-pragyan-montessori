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
<script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.2.2/js/dataTables.buttons.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.2.2/js/buttons.flash.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.2.2/js/buttons.html5.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.2.2/js/buttons.print.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>

<body>

    <div class="main-wrapper">

        @include('admin_layouts.nav')


        @include('admin_layouts.sidebar')


        <div class="page-wrapper">
            <div class="content container-fluid">

                <div class="page-header">
                    <div class="row align-items-center">
                        <div class="col">
                            <h3 class="page-title">Add Expense</h3>
                            <ul class="breadcrumb">
                                <li class="breadcrumb-item"><a href="{{ url('admin/dashboard') }}">@lang('translation.dashboard')</a>
                                </li>
                                <li class="breadcrumb-item active">Add Expense</li>
                            </ul>
                        </div>
                    </div>
                </div>



                <div class="row">
                    <div class="col-md-6 col-xl-4"></div>
                    <div class="col-md-6 col-xl-4 text-center">
                        <h3 class="m-gray">Add Expense</h3>
                        <hr>
                        <form action="{{url('admin/day-book/add-expense')}}" method="POST">
                            @csrf
                            <input type="date" name="date" class="form-control">
                            @error('date')
                                <p class="text-danger">{{$message}}</p>
                            @enderror

                            <input  list="" id="input" class="form-control m-t-10"
                                placeholder="Expense Description" name="description" autocomplete="off">
                                 @error('description')
                                <p class="text-danger">{{$message}}</p>
                            @enderror

                            <datalist id="browsers" role="listbox">
                            </datalist>
                            <input type="number" name="expense_amount" step="any" class="form-control m-t-10"
                                placeholder="Expense Amount">
                                 @error('expense_amount')
                                <p class="text-danger">{{$message}}</p>
                            @enderror
                            <hr>
                            <button type="submit" name="addexpense" id="submitBtn" class="submit btn btn-primary"><i class="bi bi-check2-circle"></i> Submit</button>
                        </form>
                    </div>
                    <div class="col-md-6 col-xl-4"></div>
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
