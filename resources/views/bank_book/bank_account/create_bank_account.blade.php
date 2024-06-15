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

<body>

    <div class="main-wrapper">

        @include('admin_layouts.nav')


        @include('admin_layouts.sidebar')


        <div class="page-wrapper">
            <div class="content container-fluid">

                <div class="page-header">
                    <div class="row align-items-center">
                        <div class="col">
                            <h3 class="page-title">Create Bank Account</h3>
                            <ul class="breadcrumb">
                                <li class="breadcrumb-item"><a href="{{ url('admin/bank-book') }}">Bank Book</a></li>
                                <li class="breadcrumb-item active">Create Bank Account</li>
                            </ul>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-sm-12">
                        <div class="card">
                            <div class="card-body">
                                <form action="{{ url('admin/bank-book/create-bank-account') }}" method="POST"
                                    enctype="multipart/form-data">
                                    @csrf
                                    <div class="row">
                                        <div class="col-12">
                                            <h5 class="form-title"><span>Fill All Bank Details</span></h5>
                                        </div>

                                        <div class="col-12 col-sm-6">
                                            <div class="form-group local-forms">
                                                <label>Bank Name <span class="login-danger">*</span></label>
                                                <input type="text" class="form-control" name="bank_name"
                                                    placeholder="Enter Bank Name">
                                                @error('bank_name')
                                                    <p class="text-danger">{{ $message }}</p>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-12 col-sm-6">
                                            <div class="form-group local-forms">
                                                <label>Account Holder Name <span class="login-danger">*</span></label>
                                                <input type="text" class="form-control" name="account_holder_name"
                                                    placeholder="Enter Account Holder Name">
                                                @error('account_holder_name')
                                                    <p class="text-danger">{{ $message }}</p>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-12 col-sm-6">
                                            <div class="form-group local-forms">
                                                <label>Account Number <span class="login-danger">*</span></label>
                                                <input type="text" class="form-control" name="account_number"
                                                    placeholder="Enter Account Name">
                                                @error('account_number')
                                                    <p class="text-danger">{{ $message }}</p>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-12 col-sm-6">
                                            <div class="form-group local-forms">
                                                <label>Account Type <span class="login-danger">*</span></label>
                                                <select class="form-control select2" name="account_type">
                                                    <option value="">Select an Option</option>
                                                    <option value="Saving Account">Saving Account</option>
                                                    <option value="Current Account">Current Account</option>
                                                    <option value="Fixed Deposit Account">Fixed Deposit Account</option>
                                                </select>
                                                @error('account_type')
                                                    <p class="text-danger">{{ $message }}</p>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-12 col-sm-6">
                                            <div class="form-group local-forms">
                                                <label>Current Balance <span class="login-danger">*</span></label>
                                                <input type="number" class="form-control" name="current_balance"
                                                    placeholder="Enter Current Balance">
                                                @error('current_balance')
                                                    <p class="text-danger">{{ $message }}</p>
                                                @enderror
                                            </div>
                                        </div>


                                        <div class="col-12 mt-4">
                                            <div class="student-submit">
                                                <button type="submit" class="btn btn-primary">Submit</button>
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
