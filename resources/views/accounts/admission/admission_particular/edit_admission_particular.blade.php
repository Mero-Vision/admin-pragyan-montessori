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
<link rel="stylesheet" href="{{ url('assets/css/ckeditor.css') }}">
<link href="https://nepalidatepicker.sajanmaharjan.com.np/nepali.datepicker/css/nepali.datepicker.v4.0.1.min.css"
    rel="stylesheet" type="text/css" />

<body>

    <div class="main-wrapper">

        @include('admin_layouts.nav')


        @include('admin_layouts.sidebar')


        <div class="page-wrapper">
            <div class="content container-fluid">

                <div class="page-header">
                    <div class="row align-items-center">
                        <div class="col">
                            <h3 class="page-title">Edit Admission Invoice Particulars</h3>
                            <ul class="breadcrumb">
                                <li class="breadcrumb-item"><a
                                        href="{{ url('admin/accounts/admission') }}">Admission</a></li>
                                <li class="breadcrumb-item active">Admission Invoice Particulars</li>
                            </ul>
                        </div>
                    </div>
                </div>

                {{-- <div class="row mb-3">

                    <div class="col-lg-3 col-md-6">

                        <div class="search-student-btn">
                           
                            <a href="{{ url('admin/cms/teachers/add') }}" class="btn btn-primary" data-bs-toggle="modal"
                                data-bs-target="#standard-modal">View Admission List</a>
                        </div>

                    </div>


                </div> --}}



                <div class="row">
                    <div class="col-sm-12">
                        <div class="card">
                            <div class="card-body">
                                <form
                                    action="{{ url('admin/accounts/admission/admission-particulars/update') }}/{{ $admissionParticulars->id }}"
                                    method="POST" enctype="multipart/form-data">
                                    @csrf
                                    <div class="row">
                                        <div class="col-12">
                                            <h5 class="form-title"><span>Edit Admission Particular</span></h5>
                                        </div>

                                        <div class="col-12 col-sm-4">
                                            <div class="form-group local-forms">
                                                <label>Particular Name <span class="login-danger">*</span></label>
                                                <input type="text" class="form-control" name="particular_name"
                                                    placeholder="Enter Particular Name"
                                                    value="{{ $admissionParticulars->particulars }}">
                                                @error('particular_name')
                                                    <p class="text-danger">{{ $message }}</p>
                                                @enderror
                                            </div>
                                        </div>


                                        <div class="col-12 col-sm-4">
                                            <div class="form-group local-forms">
                                                <label>Amount </label>
                                                <input type="number" class="form-control" name="amount"
                                                    placeholder="Enter Amount"
                                                    value="{{ $admissionParticulars->amount }}">
                                                @error('amount')
                                                    <p class="text-danger">{{ $message }}</p>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-12 col-sm-4">
                                            <div class="form-group local-forms">
                                                <label>Order Number <span class="login-danger">*</span></label>
                                                <input type="number" class="form-control"
                                                    placeholder="Enter Order Number" name="order_number"
                                                    value="{{ $admissionParticulars->order_number }}">
                                                @error('order_number')
                                                    <p class="text-danger">{{ $message }}</p>
                                                @enderror
                                            </div>
                                        </div>


                                        <div class="col-12 mt-1">
                                            <div class="student-submit">
                                                <a href="{{ url('admin/accounts/admission/admission-particulars') }}"
                                                    class="btn btn-primary">Return Back</a>
                                                <button type="submit" class="btn btn-primary">Update</button>
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







        @include('admin_layouts.footer2')

    </div>
    <script src="{{ url('assets/js/ckeditor.js') }}"></script>
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
