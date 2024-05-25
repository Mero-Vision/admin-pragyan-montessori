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

                {{-- <div class="row mb-3">

                    <div class="col-lg-3 col-md-6">

                        <div class="search-student-btn">
                            <a href="{{ url('admin/students/add') }}" class="btn btn-primary">Add New
                                Student</a>
                        </div>

                    </div>


                </div> --}}


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
                                                <th>Gender</th>
                                                <th>DOB</th>
                                                <th>Email</th>
                                                <th>Mobile No</th>
                                                <th>Address</th>
                                                <th>Roll No</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>

                                        </tbody>
                                    </table>
                                </div>


                            </div>
                        </div>
                    </div>
                </div>



            </div>
        </div>


        <!-- Add this modal code to your HTML -->
        <div class="modal fade" id="confirmationModal" tabindex="-1" aria-labelledby="confirmationModalLabel"
            aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="confirmationModalLabel">Confirm Deletion</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        Are you sure you want to delete this event?
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                        <button type="button" class="btn btn-danger" id="confirmDeleteBtn">Delete</button>
                    </div>
                </div>
            </div>
        </div>



        <script>
            $(document).ready(function() {
                $('#table_data').DataTable({
                    ajax: {
                        url: '/admin/students/data',
                        type: 'GET',
                        dataType: 'json',
                        processing: true,
                        serverSide: true,
                    },
                    processing: true,

                    "columns": [{
                            "data": "id"
                        },
                        {
                            data: "name",

                        },
                        {
                            data: "gender",

                        },
                        {
                            data: "dob",

                        },
                        {
                            "data": "email"
                        },
                        {
                            "data": "mobile_no"
                        },
                        {
                            "data": "address"
                        },
                        {
                            "data": "roll_number"
                        },

                        {
                            data: null,
                            render: function(data, type, row) {
                                return '<button class="btn btn-danger btn-sm" onclick="deleteEvent(' +
                                    row.id +
                                    ')">Delete</button> <button class="btn btn-warning btn-sm" onclick="editEvent(' +
                                    row.id +
                                    ')">Edit</button> <button class="btn btn-success btn-sm" onclick="viewStudent(' +
                                    row.id + ')">View</button>';
                            }
                        }


                    ],
                    order: [
                        [1, 'desc']
                    ],
                    "dom": 'Bfrtip',
                    "buttons": [{
                            "extend": 'copyHtml5',
                            "title": 'Data'
                        },
                        {
                            "extend": 'excelHtml5',
                            "title": 'Data'
                        },
                        {
                            "extend": 'csvHtml5',
                            "title": 'Data'
                        },
                        {
                            "extend": 'pdfHtml5',
                            "title": 'Data'
                        },
                        {
                            "extend": 'print',
                            "title": 'Print'
                        }
                    ]
                });
            });

            function deleteEvent(id) {

                $('#confirmationModal').modal('show');


                $('#confirmDeleteBtn').on('click', function() {

                    $('#confirmationModal').modal('hide');


                    $.ajax({
                        url: '/admin/cms/events/delete/' + id,
                        type: 'GET',
                        data: {
                            _method: 'DELETE'
                        },
                        success: function(response) {
                            if (response.status === 'success') {

                                $('#table_data').DataTable().ajax.reload();
                            } else {

                            }
                        },
                        error: function(xhr, status, error) {
                            console.error(xhr.responseText);
                        }
                    });
                });
            }
        </script>

        <script>
            function viewStudent(id) {
                var baseUrl = '{{ url('admin/students/view/') }}';
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
