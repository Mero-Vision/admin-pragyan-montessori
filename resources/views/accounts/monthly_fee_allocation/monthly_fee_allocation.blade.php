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

                            <ul class="breadcrumb">
                                <li class="breadcrumb-item"><a href="{{ url('admin/dashboard') }}">@lang('translation.dashboard')</a>
                                </li>
                                <li class="breadcrumb-item active">Allocate Student Monthly Fee</li>
                            </ul>
                        </div>
                    </div>
                </div>

                <div class="row mb-3">

                    <div class="col-md-12">
                        <div class="card bg-white">
                            <div class="card-header">
                                <h5 class="card-title">Allocate Monthly Fee</h5>
                            </div>
                            <div class="card-body">
                                <ul class="nav nav-tabs nav-tabs-solid nav-tabs-rounded nav-justified">
                                    @foreach ($classes as $index => $class)
                                        <li class="nav-item">
                                            <a class="nav-link {{ $index === 0 ? 'active' : '' }}"
                                                href="#tab{{ $index }}" data-bs-toggle="tab">
                                                {{ $class->class_name }}
                                            </a>
                                        </li>
                                    @endforeach
                                </ul>
                                <div class="tab-content">
                                    @foreach ($classes as $index => $class)
                                        <div class="tab-pane {{ $index === 0 ? 'show active' : '' }}"
                                            id="tab{{ $index }}">
                                            <div class="table-responsive">
                                                <table class="table table-striped custom-table"
                                                    id="table_data{{ $index }}">
                                                    <thead>
                                                        <tr>
                                                            <th>ID</th>
                                                            <th>Student Name</th>
                                                            <th>Gender</th>
                                                            <th>Class</th>
                                                            <th>Mobile No</th>
                                                            <th>Email</th>



                                                            <th>Action</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>

                                                        @foreach ($students as $student)
                                                            @if ($student->class_id == $class->id)
                                                                @php
                                                                    $hasPendingPayment = \App\Models\MonthlyFeePayment::where(
                                                                        'student_id',
                                                                        $student->id,
                                                                    )
                                                                        ->where('payment_status', 'pending')
                                                                        ->exists();
                                                                @endphp
                                                                <tr>
                                                                    <td>{{ $student->id }}</td>
                                                                    <td>{{ $student->name }}</td>
                                                                    <td>{{ $student->gender }}</td>
                                                                    <td>{{ $student->class_name }}</td>
                                                                    <td>{{ $student->mobile_no }}</td>
                                                                    <td>{{ $student->email }}</td>
                                                                    <td>
                                                                        <a href="{{ url('admin/accounts/assign-monthly-fees') }}/{{ $student->id }}"
                                                                            class="badge badge-danger">Fees
                                                                            Assign</a>
                                                                        @if ($hasPendingPayment)
                                                                            <a href="{{ url('admin/accounts/select-payment-month/' . $student->id) }}"
                                                                                class="badge badge-primary">Pay Fees</a>
                                                                            <a href="{{ url('admin/accounts/student-monthly-fees-payments/print/' . $student->slug) }}"
                                                                                class="badge badge-success">Print
                                                                                Assigned Invoice</a>
                                                                        @endif
                                                                    </td>
                                                                </tr>
                                                            @endif
                                                        @endforeach

                                                    </tbody>
                                                </table>
                                            </div>


                                        </div>


                                        <div class="modal fade" id="add_fees_collect">
                                            <div class="modal-dialog modal-dialog-centered  modal-lg">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <div class="d-flex align-items-center">
                                                            <h4 class="modal-title">Assign Fees</h4>
                                                            <spa class="badge badge-sm bg-primary ms-2">AD124556</span>
                                                        </div>
                                                        <button type="button" class="btn-close custom-btn-close"
                                                            data-bs-dismiss="modal" aria-label="Close">
                                                            <i class="ti ti-x"></i>
                                                        </button>
                                                    </div>
                                                    <form
                                                        action="https://preschool.dreamstechnologies.com/laravel/template/public/collect-fees">
                                                        <div class="modal-body">
                                                            <div class="bg-light-300 p-3 pb-0 rounded">
                                                                <div class="row align-items-center">
                                                                    <div class="col-lg-3 col-md-6">
                                                                        <div class="d-flex align-items-center mb-3">
                                                                            <a href="https://preschool.dreamstechnologies.com/laravel/template/public/student-details"
                                                                                class="avatar avatar-md me-2">
                                                                                <img src="{{ url('assets/img/user.png') }}"
                                                                                    alt="img">
                                                                            </a>
                                                                            <a class="d-flex flex-column"><span
                                                                                    class="text-dark"
                                                                                    id="studentNameLabel">Janet</a>
                                                                        </div>
                                                                    </div>

                                                                    <div class="col-lg-3 col-md-6">
                                                                        <div class="mb-3">
                                                                            <span class="badge badge-soft-danger"><i
                                                                                    class="ti ti-circle-filled me-2"></i>Unpaid</span>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="row">
                                                                <div class="col-lg-6">
                                                                    <div class="mb-3">
                                                                        <label class="form-label">Student Name</label>
                                                                        <input type="text" class="form-control"
                                                                            id="student-name" readonly>
                                                                    </div>
                                                                </div>

                                                                <div class="col-lg-6">
                                                                    <div class="mb-3">
                                                                        <label class="form-label">Last Payment
                                                                            Date</label>
                                                                        <div class="date-pic">
                                                                            <input type="text"
                                                                                class="form-control datetimepicker"
                                                                                placeholder="Select">
                                                                            <span class="cal-icon"><i
                                                                                    class="ti ti-calendar"></i></span>
                                                                        </div>
                                                                    </div>
                                                                </div>




                                                            </div>


                                                            <div class="table-responsive">
                                                                <table class="table table-invoice">
                                                                    <thead>
                                                                        <tr>
                                                                            <th>ID</th>
                                                                            <th>Particular Name</th>
                                                                            <th>Amount</th>
                                                                        </tr>
                                                                    </thead>
                                                                    <tbody>
                                                                        @php
                                                                            $counter = 2;
                                                                        $totalAmount = 0; @endphp
                                                                        <tr>
                                                                            <td>1</td>
                                                                            <td>Monthly Fees</td>

                                                                            <td>
                                                                                <input
                                                                                    class="form-control py-0 my-0 amount-input"
                                                                                    type="number"
                                                                                    id="student_monthly_fees"
                                                                                    name="monthly_fees" required>
                                                                            </td>
                                                                        </tr>
                                                                        @forelse ($monthlyParticulars as $monthlyParticular)
                                                                            @if ($monthlyParticular->class_id == $class->id)
                                                                                <tr>
                                                                                    <td>{{ $loop->index + 1 }}</td>
                                                                                    <td>
                                                                                        <p>{{ $monthlyParticular->particulars }}
                                                                                        </p>
                                                                                        <input type="hidden"
                                                                                            value="{{ $monthlyParticular->particulars }}"
                                                                                            name="particulars[{{ $loop->index }}][particular_name]" />
                                                                                    </td>
                                                                                    <td>
                                                                                        <input
                                                                                            class="form-control py-0 my-0 amount-input"
                                                                                            type="number"
                                                                                            value="{{ $monthlyParticular->amount }}"
                                                                                            name="particulars[{{ $loop->index }}][particular_amount]">
                                                                                    </td>
                                                                                </tr>
                                                                                @php
                                                                                    $totalAmount +=
                                                                                        $monthlyParticular->amount;
                                                                                @endphp
                                                                            @endif
                                                                        @empty
                                                                            <tr>
                                                                                <td colspan="3">No particulars found
                                                                                </td>
                                                                            </tr>
                                                                        @endforelse
                                                                    </tbody>
                                                                </table>

                                                            </div>



                                                        </div>
                                                        <div class="modal-footer">
                                                            <a href="#" class="btn btn-light me-2"
                                                                data-bs-dismiss="modal">Cancel</a>
                                                            <button type="submit" class="btn btn-primary">Assign
                                                                Fees</button>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>

                        </div>
                    </div>


                </div>



            </div>
        </div>




        <script>
            $(document).ready(function() {
                $('#add_fees_collect').on('show.bs.modal', function(event) {
                    var button = $(event.relatedTarget); // Button that triggered the modal
                    var id = button.data('id');
                    var name = button.data('name');
                    var gender = button.data('gender');
                    var className = button.data('class');
                    var mobile = button.data('mobile');
                    var email = button.data('email');
                    var monthly_fee = button.data('monthly_fees');

                    var modal = $(this);
                    modal.find('#student-id').val(id);
                    modal.find('#student-name').val(name);
                    modal.find('#student-gender').val(gender);
                    modal.find('#student-class').val(className);
                    modal.find('#student-mobile').val(mobile);
                    modal.find('#student-email').val(email);
                    modal.find('#student_monthly_fees').val(monthly_fee);


                    $('#studentNameLabel').text(name);
                });
            });
        </script>


        <script>
            $(document).ready(function() {
                $('#table_data0').DataTable({
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

                $('a[data-bs-toggle="tab"]').on('shown.bs.tab', function(e) {
                    var target = $(e.target).attr("href");
                    var tableId = target + ' table';
                    if (!$.fn.DataTable.isDataTable(tableId)) {
                        $(tableId).DataTable({
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
                    }
                });
            });
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
