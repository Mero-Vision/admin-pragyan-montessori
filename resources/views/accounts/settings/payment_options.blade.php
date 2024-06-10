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

                <div class="page-header">
                    <div class="row">
                        <div class="col">
                            <h3 class="page-title">Account Settings</h3>
                            <ul class="breadcrumb">
                                <li class="breadcrumb-item"><a href="{{ url('admin/dashboard') }}">Dashboard</a>
                                </li>
                                <li class="breadcrumb-item active">Account Settings</li>
                            </ul>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-xl-3 col-md-4">
                        <div class="widget settings-menu">
                            <ul>
                                <li class="nav-item">
                                    <a href="{{ url('admin/accounts/settings/payment-options') }}"
                                        class="nav-link active font-weight-600 bg-light p-1 px-3 mx-auto d-block text-center text-dark">
                                        <i class="fe fe-git-commit"></i> <span>Payment Options</span>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{ url('admin/accounts/settings/late-payment-fine') }}"
                                        class="nav-link font-weight-600 bg-light p-1 px-3 mx-auto d-block text-center text-dark">
                                        <i class="fe fe-git-commit"></i> <span>Penalty Interest Rate</span>
                                    </a>
                                </li>

                            </ul>
                        </div>
                    </div>
                    <div class="col-xl-9 col-md-8">
                        <div class="card invoices-settings-card">
                            <div class="card-header d-flex justify-content-between align-items-center">
                                <h5 class="card-title mb-0">Payment Modes</h5>
                                <div class="search-student-btn">
                                    <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                                        data-bs-target="#login-modal">Add New Payment Mode</button>
                                </div>
                            </div>
                            <div class="card-body">

                                <div class="table-responsive">
                                    <table class="table table-striped custom-table" id="table_data">
                                        <thead>
                                            <tr>
                                                <th>ID</th>
                                                <th>Payment Name</th>
                                                <th>Created By</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($paymentOptions as $paymentOption)
                                                <tr>
                                                    <td>{{ $paymentOption->id }}</td>
                                                    <td>{{ $paymentOption->payment_name }}</td>
                                                    <td>{{ $paymentOption->user }}</td>
                                                    <td>
                                                        <a href="#" class="badge badge-danger enable-user-btn p-2"
                                                            data-user-id="{{ $paymentOption->slug }}">Delete<a>
                                                    </td>


                                                </tr>
                                            @endforeach

                                        </tbody>
                                    </table>
                                </div>



                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>


        <!-- Delete Payment Option Model -->
        <div class="modal fade" id="confirmationModal" tabindex="-1" role="dialog"
            aria-labelledby="confirmationModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="confirmationModalLabel">Confirm Disable</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">

                        </button>
                    </div>
                    <div class="modal-body">
                        Are you sure you want to delete this payment option?
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                        <a id="confirmDisableBtn" href="#" class="btn btn-warning text-light">Yes, Delete</a>
                    </div>
                </div>
            </div>
        </div>





        <script>
            $(document).ready(function() {
                $('.enable-user-btn').on('click', function(e) {
                    e.preventDefault();
                    var userId = $(this).data('user-id');
                    $('#confirmDisableBtn').attr('href',
                        "{{ url('admin/accounts/settings/payment-options/delete') }}/" + userId);
                    $('#confirmationModal').modal('show');
                });
            });
        </script>



        <div id="login-modal" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="scrollableModalTitle">New Payment Mode</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">

                        @livewire('payment-mode-form')




                    </div>
                </div>
            </div>
        </div>





        @include('admin_layouts.footer2')

    </div>

    <script>
        $(document).ready(function() {
            // Initialize DataTables with styling
            $('#table_data').DataTable({
                "paging": true,
                "lengthChange": true,
                "searching": true,
                "info": true,
                "autoWidth": false,
                "order": [
                    [0, 'desc']
                ],
                "language": {
                    "paginate": {
                        "next": "Next",
                        "previous": "Prev"
                    }
                }
            });
        });
    </script>

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
