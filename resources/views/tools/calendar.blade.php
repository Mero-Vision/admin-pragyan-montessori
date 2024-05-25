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

                <div class="row">
                    <div class="col-md-8">
                        <!-- Start of nepali calendar widget -->
                        <script type="text/javascript">
                            <!--
                            var nc_width = 'responsive';
                            var nc_height = 750;
                            var nc_api_id = "582159o346"; //
                            -->
                        </script>
                        <script type="text/javascript" src="https://www.ashesh.com.np/nepali-calendar/js/ncf.js?v=5"></script>
                        <!-- End of nepali calendar widget -->
                    </div>

                    <div class="col-md-4">
                        <!-- Start of upcoming event widget -->
                        <script type="text/javascript">
                            <!--
                            var nc_ev_width = 'responsive';
                            var nc_ev_height = 650;
                            var nc_ev_def_lan = 'np';
                            var nc_ev_api_id = 48920240525874; //
                            -->
                        </script>
                        <script type="text/javascript" src="https://www.ashesh.com.np/calendar-event/ev.js"></script>
                        

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
