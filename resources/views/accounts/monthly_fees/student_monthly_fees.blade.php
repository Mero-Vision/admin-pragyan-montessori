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
                            <h3 class="page-title">Student List</h3>
                            <ul class="breadcrumb">
                                <li class="breadcrumb-item"><a href="{{ url('admin/dashboard') }}">@lang('translation.dashboard')</a>
                                </li>
                                <li class="breadcrumb-item active">Student List</li>
                            </ul>
                        </div>
                    </div>
                </div>

                <div class="row mb-3">

                    <div class="col-lg-5 col-md-6">

                        <div class="search-student-btn">

                            <a href="{{ url('admin/accounts/monthly-fees-particulars') }}"
                                class="btn btn-primary">Create Monthly Fees Particulars</a>
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
                                                <th>Student Name</th>
                                                <th>Gender</th>
                                                <th>Mobile No</th>
                                                <th>Email</th>



                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($students as $student)
                                                <tr>
                                                    <td>{{ $student->id }}</td>
                                                    <td>{{ $student->name }}</td>
                                                    <td>{{ $student->gender }}</td>
                                                    <td>{{ $student->mobile_no }}</td>
                                                    <td>{{ $student->email }}</td>
                                                    <td>
                                                        <a href="{{ url('admin/accounts/student-monthly-fees-payments') }}/{{ $student->id }}"
                                                            class="btn btn-danger">Go to Payment</a>
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
