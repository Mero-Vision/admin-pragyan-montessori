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
                            <h3 class="page-title">Admission Payment Report</h3>
                            <ul class="breadcrumb">
                                <li class="breadcrumb-item"><a href="{{ url('admin/reports') }}">Reports</a>
                                </li>
                                <li class="breadcrumb-item active">Admission Payment</li>
                            </ul>
                        </div>
                    </div>
                </div>

                <div class="row mb-3">

                    <div class="col-lg-6 col-md-6">

                        <form action="{{ url('admin/reports/sales-report/admission-payment') }}" method="get"
                            class="m-gray">
                            <input type="date" name="start_date"
                                style="padding:5px;border:none;background:none;border-bottom:1px solid gray;" required>
                            <b>To:</b>
                            <input type="date" name="end_date"
                                style="padding:5px;border:none;background:none;border-bottom:1px solid gray;" required>
                            <button type="submit" class="btn btn-primary" style="margin:10px;"><i
                                    class="bi bi-search"></i> Search</button>
                        </form>

                    </div>


                </div>


                <div class="row">
                    <div class="col-lg-12 col-md-12">
                        <div class="card">
                            <div class="card-body">

                                <div class="table-responsive">
                                    <table class="table table-striped table-bordered" id="table_data">
                                        <thead>
                                            <tr>
                                                <th>ID</th>
                                                <th>Name</th>
                                                 <th>Class</th>
                                                <th>Gross Total</th>
                                                <th>Discount</th>
                                                <th>Net Total</th>
                                                <th>Credit</th>
                                                <th>Paid</th>
                                                <th>Operated By</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($admissionPayments as $data)
                                                <tr>
                                                    <td>{{ $data->id }}</td>
                                                    <td>{{ $data->name }}</td>
                                                     <td>{{ $data->class_name }}</td>
                                                    <td>{{ $data->sub_total }}</td>
                                                    <td>{{ $data->discount_amount }}</td>
                                                    <td>{{ $data->net_total }}</td>
                                                    <td>{{ $data->credit_amount }}</td>
                                                    <td>{{ $data->paid_amount }}</td>
                                                    <td>{{ $data->user }}</td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                        <tfoot>
                                            <tr>
                                                <th colspan="3">Total:</th>
                                                <th id="gross_total_sum"></th>
                                                <th id="discount_sum"></th>
                                                <th id="net_total_sum"></th>
                                                <th id="credit_sum"></th>
                                                <th id="paid_sum"></th>
                                                <th></th>
                                            </tr>
                                        </tfoot>
                                    </table>
                                </div>


                            </div>
                        </div>
                    </div>
                </div>



            </div>
        </div>


        <script>
            document.addEventListener('DOMContentLoaded', function() {
                let grossTotalSum = 0;
                let discountSum = 0;
                let netTotalSum = 0;
                let creditSum = 0;
                let paidSum = 0;

                document.querySelectorAll('#table_data tbody tr').forEach(row => {
                    grossTotalSum += parseFloat(row.cells[3].innerText) || 0;
                    discountSum += parseFloat(row.cells[4].innerText) || 0;
                    netTotalSum += parseFloat(row.cells[5].innerText) || 0;
                    creditSum += parseFloat(row.cells[6].innerText) || 0;
                    paidSum += parseFloat(row.cells[7].innerText) || 0;
                });

                document.getElementById('gross_total_sum').innerText = 'Rs. ' + grossTotalSum.toFixed(2);
                document.getElementById('discount_sum').innerText = 'Rs. ' + discountSum.toFixed(2);
                document.getElementById('net_total_sum').innerText = 'Rs. ' + netTotalSum.toFixed(2);
                document.getElementById('credit_sum').innerText = 'Rs. ' + creditSum.toFixed(2);
                document.getElementById('paid_sum').innerText = 'Rs. ' + paidSum.toFixed(2);
            });
        </script>





        <script>
            $(document).ready(function() {
                $('#table_data').DataTable({
                    "paging": false,
                    "lengthChange": false,
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
                    },
                    "dom": 'Bfrtip',
                    "buttons": [{
                            "extend": 'copyHtml5',
                            "title": 'Admission Payment Report'
                        },
                        {
                            "extend": 'excelHtml5',
                            "title": 'Admission Payment Report'
                        },
                        {
                            "extend": 'csvHtml5',
                            "title": 'Admission Payment Report'
                        },
                        {
                            "extend": 'pdfHtml5',
                            "title": 'Admission Payment Report'
                        },
                        {
                            "extend": 'print',
                            "title": 'Admission Payment Report',
                            "customize": function(win) {
                                $(win.document.body)
                                    .css('font-size', '10pt')
                                    .prepend(
                                        '<style>' +
                                        'body { margin: 0; padding: 0; }' +
                                        'table { width: 100%; border-collapse: collapse; }' +
                                        'table, th, td { border: 1px solid black; }' +
                                        '</style>'
                                    );

                                $(win.document.body).find('h1').css('display', 'none'); 
                            }
                        }
                    ]
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
