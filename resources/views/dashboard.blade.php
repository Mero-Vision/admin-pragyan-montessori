<!DOCTYPE html>
<html lang="en">

@include('admin_layouts.header')

<body>

    <div class="main-wrapper">

        @include('admin_layouts.nav')


        @include('admin_layouts.sidebar')


        <div class="page-wrapper">
            <div class="content container-fluid">

                <div class="d-md-flex d-block align-items-center justify-content-between mb-3">
                    <div class="my-auto mb-2">
                        <h3 class="page-title mb-1">Admin Dashboard</h3>
                        <nav>
                            <ol class="breadcrumb mb-0">
                                <li class="breadcrumb-item">
                                    <a href="javascript:void(0);">Dashboard</a>
                                </li>
                                <li class="breadcrumb-item active" aria-current="page">Admin Dashboard</li>
                            </ol>
                        </nav>
                    </div>
                    <div class="d-flex my-xl-auto right-content align-items-center flex-wrap">
                        <div class="mb-2">
                            <a href="{{ url('admin/accounts/admission/create') }}"
                                class="btn btn-primary d-flex align-items-center me-3"><i
                                    class="ti ti-square-rounded-plus me-2"></i>Add New Student</a>
                        </div>
                        <div class="mb-2">
                            <a href="{{ url('admin/accounts/student-monthly-fees-payments') }}"
                                class="btn btn-light d-flex align-items-center">Fees Details</a>
                        </div>
                    </div>
                </div>

                <div class="card bg-dark">
                    <div class="overlay-img">
                        <img src="{{url('assets/img/shape1.webp')}}"
                            alt="img" class="img-fluid shape-01" style="width:30px">
                        <img src="{{url('assets/img/shape2.png')}}"
                            alt="img" class="img-fluid shape-02" style="width:30px">
                        <img src="{{url('assets/img/shape3.png')}}"
                            alt="img" class="img-fluid shape-03" style="width:30px">
                        <img src="{{url('assets/img/shape1.webp')}}"
                            alt="img" class="img-fluid shape-04" style="width:30px">
                    </div>
                    <div class="card-body">
                        <div class="d-flex align-items-xl-center justify-content-xl-between flex-xl-row flex-column">
                            <div class="mb-3 mb-xl-0">
                                <div class="d-flex align-items-center flex-wrap mb-2">
                                    <h1 class="text-white me-2">Welcome Back, {{ Auth()->user()->name }}</h1>
                                    <a href="{{ url('admin/dashboard') }}"
                                        class="avatar avatar-sm img-rounded bg-gray-800 dark-hover"><i
                                            class="ti ti-edit text-white"></i></a>
                                </div>
                                @php
                                    use Carbon\Carbon;
                                @endphp
                                @php
                                    $currentHour = Carbon::now()->format('H');
                                    $currentDate = Carbon::now()->format('l, F j, Y'); // e.g., "Wednesday, July 17, 2024"

                                    if ($currentHour >= 5 && $currentHour < 12) {
                                        $greeting = 'Good Morning';
                                        $message = "Let's have a productive start to the day!";
                                    } elseif ($currentHour >= 12 && $currentHour < 17) {
                                        $greeting = 'Good Afternoon';
                                        $message = 'Keep up the great work this afternoon!';
                                    } elseif ($currentHour >= 17 && $currentHour < 21) {
                                        $greeting = 'Good Evening';
                                        $message = 'Time to wrap up the day!';
                                    } else {
                                        $greeting = 'Good Night';
                                        $message = 'Have a restful night and recharge for tomorrow!';
                                    }
                                @endphp

                                <p class="text-white">{{ $greeting }}!
                                    {{ $message }}</p>

                            </div>
                            <p class="text-white"><i class="ti ti-refresh me-1"></i>Today Date:
                                {{ \Carbon\Carbon::now()->format('Y-m-d') }}</p>
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
                                                        class="fas fa-ellipsis-v"></i></a>
                                            </li>
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
                                                        class="fas fa-ellipsis-v"></i></a>
                                            </li>
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
            var labels = ['Baisakh', 'Jestha', 'Ashadh', 'Shrawan', 'Bhadra', 'Ashwin', 'Kartik', 'Mangsir',
                'Poush', 'Magh', 'Falgun', 'Chaitra'
            ];
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
            var labels = ['Baisakh', 'Jestha', 'Ashadh', 'Shrawan', 'Bhadra', 'Ashwin', 'Kartik', 'Mangsir',
                'Poush', 'Magh', 'Falgun', 'Chaitra'
            ];
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
