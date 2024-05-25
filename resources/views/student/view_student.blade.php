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
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="page-sub-header">
                                <h3 class="page-title">Student Details</h3>
                                <ul class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="{{ url('admin/students') }}">Student</a></li>
                                    <li class="breadcrumb-item active">Student Details</li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="page-header invoices-page-header">
                    <div class="row align-items-center">
                        <div class="col-auto">
                            <ul class="breadcrumb invoices-breadcrumb">
                                <li class="breadcrumb-item invoices-breadcrumb-item">
                                    <a href="{{ url('admin/students') }}">
                                        <i class='bx bx-arrow-back'></i> Back to Student List
                                    </a>
                                </li>
                            </ul>
                        </div>

                    </div>
                </div>

                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="about-info">
                                    <h4>Profile <span><a href="javascript:;"><i
                                                    class="feather-more-vertical"></i></a></span></h4>
                                </div>
                                <div class="student-profile-head">
                                    <div class="profile-bg-img">
                                        <img src="{{ url('assets/img/background.jpeg') }}" alt="Profile"
                                            style="height: 150px;">
                                    </div>
                                    <div class="row">
                                        <div class="col-lg-4 col-md-4">
                                            <div class="profile-user-box">
                                                <div class="profile-user-img">
                                                    <img src="{{ Avatar::create($student->name)->toBase64() }}"
                                                        alt="Profile">
                                                </div>
                                                <div class="names-profiles">
                                                    <h4>{{ $student->name }}</h4>
                                                    <h5>DOB: {{ $student->dob }}
                                                        ({{ \Carbon\Carbon::parse($student->dob)->age }} years old)</h5>

                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-4 col-md-4 d-flex align-items-center">
                                        </div>
                                        <div class="col-lg-4 col-md-4 d-flex align-items-center">
                                            <div class="follow-btn-group">
                                                {{-- <button type="submit" class="btn btn-info follow-btns">Follow</button> --}}
                                                <button type="submit"
                                                    class="btn btn-primary">View Admission Details</button>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-4">
                                    <div class="student-personals-grp">
                                        <div class="card">
                                            <div class="card-body">
                                                <div class="heading-detail">
                                                    <h4>Personal Details :</h4>
                                                </div>
                                                <div class="personal-activity">
                                                    <div class="personal-icons">
                                                        <i class="feather-user"></i>
                                                    </div>
                                                    <div class="views-personal">
                                                        <h4>Name</h4>
                                                        <h5>{{ $student->name }}</h5>
                                                    </div>
                                                </div>

                                                <div class="personal-activity">
                                                    <div class="personal-icons">
                                                        <i class="feather-users"></i>
                                                    </div>
                                                    <div class="views-personal">
                                                        <h4>Class</h4>
                                                        <h5>{{ $class->class_name }}</h5>
                                                    </div>
                                                </div>


                                                <div class="personal-activity">
                                                    <div class="personal-icons">
                                                        <i class="feather-phone-call"></i>
                                                    </div>
                                                    <div class="views-personal">
                                                        <h4>Mobile</h4>
                                                        <h5>{{ $student->mobile_no }}</h5>
                                                    </div>
                                                </div>
                                                <div class="personal-activity">
                                                    <div class="personal-icons">
                                                        <i class="feather-mail"></i>
                                                    </div>
                                                    <div class="views-personal">
                                                        <h4>Email</h4>
                                                        <h5>{{ $student->email }}</h5>
                                                    </div>
                                                </div>
                                                <div class="personal-activity">
                                                    <div class="personal-icons">
                                                        <i class="feather-user"></i>
                                                    </div>
                                                    <div class="views-personal">
                                                        <h4>Gender</h4>
                                                        <h5>{{ $student->gender }}</h5>
                                                    </div>
                                                </div>
                                                <div class="personal-activity">
                                                    <div class="personal-icons">
                                                        <i class="feather-calendar"></i>
                                                    </div>
                                                    <div class="views-personal">
                                                        <h4>Date of Birth</h4>
                                                        <h5>{{ $student->dob }}</h5>
                                                    </div>
                                                </div>

                                                <div class="personal-activity">
                                                    <div class="personal-icons">
                                                        <i class="feather-edit-3"></i>
                                                    </div>
                                                    <div class="views-personal">
                                                        <h4>Roll No</h4>
                                                        <h5>{{ $student->roll_number }}</h5>
                                                    </div>
                                                </div>


                                                <div class="personal-activity">
                                                    <div class="personal-icons">
                                                        <i class="feather-search"></i>
                                                    </div>
                                                    <div class="views-personal">
                                                        <h4>Admission ID</h4>
                                                        <h5>{{ $student->admission_id }}</h5>
                                                    </div>
                                                </div>

                                                 <div class="personal-activity">
                                                    <div class="personal-icons">
                                                        <i class="feather-dollar-sign"></i>
                                                    </div>
                                                    <div class="views-personal">
                                                        <h4>Monthly Fee Amount</h4>
                                                        <h5>Rs. {{ $student->monthly_payment_amount }}</h5>
                                                    </div>
                                                </div>

                                                <div class="personal-activity mb-0">
                                                    <div class="personal-icons">
                                                        <i class="feather-map-pin"></i>
                                                    </div>
                                                    <div class="views-personal">
                                                        <h4>Address</h4>
                                                        <h5>{{ $student->address }}</h5>
                                                    </div>
                                                </div>




                                            </div>
                                        </div>
                                    </div>



                                    <div class="student-personals-grp">
                                        <div class="card mb-0">
                                            <div class="card-body">
                                                <div class="heading-detail">
                                                    <h4>Due Amount:</h4>
                                                </div>

                                            </div>
                                        </div>
                                    </div>
                                </div>







                                <div class="col-lg-8">
                                    <div class="student-personals-grp">
                                        <div class="card mb-0">
                                            <div class="card-body">

                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>


                        </div>
                    </div>
                </div>
            </div>


            @include('admin_layouts.footer2')

            <style>
                .right-bottom-corner {
                    position: absolute;
                    bottom: 0;
                    right: 0;
                }

                .container-relative {
                    position: relative;
                }
            </style>

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
