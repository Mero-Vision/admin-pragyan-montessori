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
                            <h3 class="page-title">Admission Invoice Particulars</h3>
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
                                <form action="{{ url('admin/accounts/admission/admission-particulars') }}" method="POST"
                                    enctype="multipart/form-data">
                                    @csrf
                                    <div class="row">
                                        <div class="col-12">
                                            <h5 class="form-title"><span>Create Admission Particular</span></h5>
                                        </div>

                                        <div class="col-12 col-sm-4">
                                            <div class="form-group local-forms">
                                                <label>Particular Name <span class="login-danger">*</span></label>
                                                <input type="text" class="form-control" name="particular_name"
                                                    >
                                                @error('particular_name')
                                                    <p class="text-danger">{{ $message }}</p>
                                                @enderror
                                            </div>
                                        </div>


                                        <div class="col-12 col-sm-4">
                                            <div class="form-group local-forms">
                                                <label>Amount </label>
                                                <input type="number" class="form-control" name="amount"
                                                    >
                                                @error('amount')
                                                    <p class="text-danger">{{ $message }}</p>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-12 col-sm-4">
                                            <div class="form-group local-forms">
                                                <label>Order Number <span class="login-danger">*</span></label>
                                                <input type="number" class="form-control"
                                                     name="order_number">
                                                @error('order_number')
                                                    <p class="text-danger">{{ $message }}</p>
                                                @enderror
                                            </div>
                                        </div>


                                        <div class="col-12 mt-1">
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



                <div class="row">
                    <div class="col-lg-12 col-md-12">
                        <div class="card">
                            <div class="card-body">

                                <div class="table-responsive">
                                    <table class="table table-striped custom-table" id="table_data">
                                        <thead>
                                            <tr>
                                                <th>ID</th>
                                                <th>Particulars</th>
                                                <th>Order Number</th>
                                                <th>Amount</th>
                                                <th>Created / Updated By</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($admissionParticulars as $admissionParticular)
                                                <tr>
                                                    <td>{{ $admissionParticular->id }}</td>
                                                    <td>{{ $admissionParticular->particulars }}</td>
                                                     <td>{{ $admissionParticular->order_number }}</td>
                                                  <td>{{ isset($admissionParticular->amount) ? "Rs. " . $admissionParticular->amount : "" }}</td>

                                             
                                                     <td>{{ $admissionParticular->user }}</td>
                                                    <td>
                                                        <a class="btn btn-danger px-2 py-1 delete-data"  data-admission-id="{{ $admissionParticular->id }}"><i class='bx bxs-message-square-x bx-sm'></i></a>
                                                        <a class="btn btn-primary px-2 py-1" href="{{url('admin/accounts/admission/admission-particulars/edit')}}/{{$admissionParticular->id}}"><i class='bx bxs-message-square-edit bx-sm'></i></a>
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


         <!-- Delete Data Model -->
        <div class="modal fade" id="deleteModal" tabindex="-1" role="dialog"
            aria-labelledby="confirmationModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="confirmationModalLabel">Delete Data Confirmation</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">

                        </button>
                    </div>
                    <div class="modal-body">
                        Are you sure you want to delete this particular?
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                        <a id="confirmDeleteBtn" href="#" class="btn btn-danger text-light">Delete</a>
                    </div>
                </div>
            </div>
        </div>

         <script>
            $(document).ready(function() {
                $('.delete-data').on('click', function(e) {
                    e.preventDefault();
                    var userId = $(this).data('admission-id');
                    $('#confirmDeleteBtn').attr('href', "{{ url('admin/accounts/admission/admission-particulars/delete') }}/" + userId);
                    $('#deleteModal').modal('show');
                });
            });

           
        </script>




        <script>
            $(document).ready(function() {
                $('#table_data').DataTable({
                    "paging": true,
                    "lengthChange": true,
                    "searching": true,
                    "info": true,
                    "autoWidth": false,
                    "order": [
                        [2, 'asc']
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
