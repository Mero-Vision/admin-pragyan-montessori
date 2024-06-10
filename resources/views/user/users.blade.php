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
                    <div class="row align-items-center">
                        <div class="col">
                            <h3 class="page-title">User Management</h3>
                            <ul class="breadcrumb">
                                <li class="breadcrumb-item"><a href="{{ url('admin/dashboard') }}">@lang('translation.dashboard')</a>
                                </li>
                                <li class="breadcrumb-item active">User List</li>
                            </ul>
                        </div>
                    </div>
                </div>

                <div class="row mb-3">

                    <div class="col-lg-6 col-md-6">

                        <div class="search-student-btn">
                            <a href="{{ url('admin/users/create-account') }}" class="btn btn-primary">Add New
                                User</a>
                            <a href="{{ url('admin/cms/teachers/add') }}" class="btn btn-primary" data-bs-toggle="modal"
                                data-bs-target="#standard-modal">View Roles</a>
                        </div>

                    </div>


                </div>


                <div class="row">
                    <div class="col-lg-12 col-md-12">
                        <div class="card">
                            <div class="card-body">

                                <div class="table-responsive">
                                    <table class="table table-striped custom-table" id="table_data">
                                        <thead>
                                            <tr>
                                                <th>ID</th>
                                                <th>Name</th>
                                                <th>Email</th>
                                                <th>DOB</th>
                                                <th>Phone No</th>
                                                <th>Gender</th>
                                                <th>Address</th>
                                                <th>Role</th>
                                                <th>Status</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($users as $user)
                                                <tr>
                                                    <td>{{ $user->id }}</td>
                                                    <td>{{ $user->name }}</td>
                                                    <td>{{ $user->email }}</td>
                                                    <td>{{ $user->dob }}</td>
                                                    <td>{{ $user->mobile_no }}</td>
                                                    <td>{{ $user->gender }}</td>
                                                    <td>{{ $user->address }}</td>
                                                    <td>{{ $user->role }}</td>
                                                    <td>
                                                        @if ($user->deleted_at)
                                                            Inactive
                                                        @else
                                                            Active
                                                        @endif
                                                    </td>
                                                    <td>
                                                        @if ($user->deleted_at)
                                                            <a href="#"
                                                                class="badge badge-success p-2 text-light enable-user-btn"
                                                                data-user-id="{{ $user->id }}">Enable</a>
                                                        @else
                                                            <a href="#"
                                                                class="badge badge-warning p-2 text-light disable-user-btn"
                                                                data-user-id="{{ $user->id }}">Disable</a>
                                                        @endif

                                                        @if (!$user->email_verified_at)
                                                            <a href="{{url('admin/users/resend-verification')}}/{{$user->id}}" class="badge badge-primary p-2 text-light"
                                                                >Resend Verification</a>
                                                        @endif
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


        <!-- Disable User Model -->
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
                        Are you sure you want to disable this user?
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                        <a id="confirmDisableBtn" href="#" class="btn btn-warning text-light">Yes, Disable</a>
                    </div>
                </div>
            </div>
        </div>


        <!-- Enable User Model -->
        <div class="modal fade" id="confirmationEnableModal" tabindex="-1" role="dialog"
            aria-labelledby="confirmationModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="confirmationModalLabel">Confirm Enable User</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">

                        </button>
                    </div>
                    <div class="modal-body">
                        Are you sure you want to enable this user?
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                        <a id="confirmEnableBtn" href="#" class="btn btn-success text-light">Yes, Enable</a>
                    </div>
                </div>
            </div>
        </div>


        <script>
            $(document).ready(function() {
                $('.disable-user-btn').on('click', function(e) {
                    e.preventDefault();
                    var userId = $(this).data('user-id');
                    $('#confirmDisableBtn').attr('href', "{{ url('admin/users/delete') }}/" + userId);
                    $('#confirmationModal').modal('show');
                });
            });

            $(document).ready(function() {
                $('.enable-user-btn').on('click', function(e) {
                    e.preventDefault();
                    var userId = $(this).data('user-id');
                    $('#confirmEnableBtn').attr('href', "{{ url('admin/users/restore') }}/" + userId);
                    $('#confirmationEnableModal').modal('show');
                });
            });
        </script>




        <div id="standard-modal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="standard-modalLabel"
            aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="standard-modalLabel">Role List</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                            aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <table class="table" style="table-layout: fixed; width: 100%;">
                            <thead>
                                <tr>
                                    <th style="width: 50%;">ID</th>
                                    <th style="width: 50%;">Role Name</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($roles as $role)
                                    <tr>
                                        <td>{{ $role->id }}</td>
                                        <td>{{ $role->role_name }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                </div>
            </div>
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

        <script>
            function viewTeacher(id) {
                var baseUrl = '{{ url('admin/teachers/view/') }}';
                var url = baseUrl + '/' + id;


                window.location.href = url;
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
