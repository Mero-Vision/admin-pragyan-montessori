<!DOCTYPE html>
<html lang="en">

@include('admin_layouts.header')

<body>

    <div class="main-wrapper">

        @include('admin_layouts.nav')


        @include('admin_layouts.sidebar')


        <div class="page-wrapper">
            <div class="content container-fluid">

                <div class="page-header">
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="page-sub-header">
                                <h3 class="page-title">@lang('translation.welcome_text')</h3>
                                <ul class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="{{ url('admin/dashboard') }}">Home</a></li>
                                    <li class="breadcrumb-item active">Admin</li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>


                <div class="row">
                    <div class="col-xl-3 col-sm-6 col-12 d-flex">
                        <div class="card bg-comman w-100">
                            <div class="card-body">
                                <div class="db-widgets d-flex justify-content-between align-items-center">
                                    <div class="db-info">
                                        <h6>Students</h6>
                                        <h3>{{ $countStudent }}</h3>
                                    </div>
                                    <div class="db-icon">
                                        <img src="{{ url('assets/img/icons/dash-icon-01.svg') }}" alt="Dashboard Icon">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-3 col-sm-6 col-12 d-flex">
                        <div class="card bg-comman w-100">
                            <div class="card-body">
                                <div class="db-widgets d-flex justify-content-between align-items-center">
                                    <div class="db-info">
                                        <h6>Revenue</h6>
                                        <h3>Rs. {{ $totalRevenue }}</h3>
                                    </div>
                                    <div class="db-icon">
                                        <img src="{{ url('assets/img/icons/dash-icon-04.svg') }}" alt="Dashboard Icon">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-3 col-sm-6 col-12 d-flex">
                        <div class="card bg-comman w-100">
                            <div class="card-body">
                                <div class="db-widgets d-flex justify-content-between align-items-center">
                                    <div class="db-info">
                                        <h6>Classes</h6>
                                        <h3>{{ $totalClasses }}</h3>
                                    </div>
                                    <div class="db-icon">
                                        <img src="{{ url('assets/img/icons/teacher-icon-01.svg') }}"
                                            alt="Dashboard Icon">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-3 col-sm-6 col-12 d-flex">
                        <div class="card bg-comman w-100">
                            <div class="card-body">
                                <div class="db-widgets d-flex justify-content-between align-items-center">
                                    <div class="db-info">
                                        <h6>Teachers</h6>
                                        <h3>{{ $countTeachers }}</h3>
                                    </div>
                                    <div class="db-icon">
                                        <img src="{{ url('assets/img/icons/dash-icon-01.svg') }}" alt="Dashboard Icon">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-12 col-lg-12">

                        <div class="card card-chart">
                            <div class="card-header">
                                <div class="row align-items-center">
                                    <div class="col-6">
                                        <h5 class="card-title">Overview Of Student Admission Data</h5>
                                    </div>
                                    <div class="col-6">
                                        <ul class="chart-list-out">
                                            <li><span class="circle-blue"></span>Student Admission Data</li>
                                            <li class="star-menus"><a href="javascript:;"><i
                                                        class="fas fa-ellipsis-v"></i></a></li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            <div class="card-body">
                                <div id="apexcharts-area"></div>
                            </div>
                        </div>

                    </div>
                    <div class="col-md-12 col-lg-12">

                        <div class="card card-chart">
                            <div class="card-header">
                                <div class="row align-items-center">
                                    <div class="col-6">
                                        <h5 class="card-title">Overview Of Monthly Payments</h5>
                                    </div>
                                    <div class="col-6">
                                        <ul class="chart-list-out">
                                            <li><span class="circle-green"></span>Monthly Payments</li>
                                            <li class="star-menus"><a href="javascript:;"><i
                                                        class="fas fa-ellipsis-v"></i></a></li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            <div class="card-body">
                                <div id="fee-area"></div>
                            </div>
                        </div>

                    </div>
                </div>



            </div>
        </div>


        @include('admin_layouts.footer2')

    </div>


    @include('admin_layouts.footer')

   <script>
        document.addEventListener('DOMContentLoaded', function() {
            var labels = ['Baisakh', 'Jestha', 'Ashadh', 'Shrawan', 'Bhadra', 'Ashwin', 'Kartik', 'Mangsir', 'Poush', 'Magh', 'Falgun', 'Chaitra'];
            var data = @json($monthlyStudentCount);

            if (document.querySelector('#apexcharts-area')) {
                var options = {
                    chart: {
                        height: 350, 
                        type: 'line',
                        toolbar: {
                            show: false
                        },
                    },
                    dataLabels: {
                        enabled: false
                    },
                    stroke: {
                        curve: 'smooth'
                    },
                    series: [{
                        name: 'Students',
                        color: '#3D5EE1',
                        data: data
                    }],
                    xaxis: {
                        categories: labels,
                        labels: {
                            rotate: -45,
                            style: {
                                fontSize: '12px', 
                            }
                        }
                    },
                    yaxis: {
                        labels: {
                            style: {
                                fontSize: '12px' 
                            }
                        }
                    },
                    markers: {
                        size: 4 
                    }
                };

                var chart = new ApexCharts(document.querySelector('#apexcharts-area'), options);
                chart.render();
            }
        });
    </script>


<script>
        document.addEventListener('DOMContentLoaded', function() {
            var labels = ['Baisakh', 'Jestha', 'Ashadh', 'Shrawan', 'Bhadra', 'Ashwin', 'Kartik', 'Mangsir', 'Poush', 'Magh', 'Falgun', 'Chaitra'];
            var data = @json($monthlyPaymentCount);

            if (document.querySelector('#fee-area')) {
                var options = {
                    chart: {
                        height: 350, // Adjust the height as needed
                        type: 'line',
                        toolbar: {
                            show: false
                        },
                    },
                    dataLabels: {
                        enabled: false
                    },
                    stroke: {
                        curve: 'smooth'
                    },
                    series: [{
                        name: 'Monthly Payments',
                        color: '#70C4CF',
                        data: data
                    }],
                    xaxis: {
                        categories: labels,
                        labels: {
                            rotate: -45, // Rotate labels to fit vertically
                            style: {
                                fontSize: '12px', // Adjust font size as needed
                            }
                        }
                    },
                    yaxis: {
                        labels: {
                            style: {
                                fontSize: '12px' // Adjust font size as needed
                            }
                        }
                    },
                    markers: {
                        size: 4 // Adjust marker size as needed
                    }
                };

                var chart = new ApexCharts(document.querySelector('#fee-area'), options);
                chart.render();
            }
        });
    </script>
</body>

</html>
