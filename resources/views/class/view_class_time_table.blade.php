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
                            <h3 class="page-title">{{ $class->class_name }} Class Time-Table</h3>
                            <ul class="breadcrumb">
                                <li class="breadcrumb-item"><a href="{{ url('admin/dashboard') }}">Dashboard</a>
                                </li>
                                <li class="breadcrumb-item active">Class Time-Table</li>
                            </ul>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-lg-12 col-md-12">





                        @forelse ($classTimeTables as $day => $timetables)
                            <h5 class="bg-primary text-light p-1">{{ $day }}</h5>
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Start Time</th>
                                        <th>End Time</th>
                                        <th>Subject</th>
                                        <th>Created At</th>

                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($timetables as $classTimeTable)
                                        <tr>
                                            <td>{{ $classTimeTable->id }}</td>
                                            <td>{{ $classTimeTable->start_time }}</td>
                                            <td>{{ $classTimeTable->end_time }}</td>
                                            <td>{{ $classTimeTable->subject }}</td>
                                            <td>{{ $classTimeTable->created_at->format('j F Y') }}</td>

                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        @empty
                            <div class="container"><br><br>
                               <img src="{{ url('assets/img/planning.webp') }}" class="img-fluid mx-auto d-block mt-5" style="width: 250px"/>
                              <p class="text-center">No timetable exists for the {{ $class->class_name }} class. You can create a class timetable <a href="{{ url('admin/school-classes/class-time-table/create') }}">here</a>.</p>

                            </div>

                           
                        @endforelse

                    </div>
                </div>











            </div>
        </div>








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
