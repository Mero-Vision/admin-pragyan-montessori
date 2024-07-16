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
                            <h3 class="page-title"
                                style="font-family: 'Poppins', sans-serif; font-size: 28px; font-weight: 600; line-height: 20px; color: rgb(34, 34, 34); text-align: center;">
                                Edit Student Details
                            </h3>
                            <ul class="breadcrumb">
                                <li class="breadcrumb-item"><a href="{{ url('admin/students') }}">Students</a></li>
                                <li class="breadcrumb-item active">Edit Student Details</li>
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
                                <form action="{{ url('admin/students/edit') }}/{{$student->id}}" method="POST"
                                    enctype="multipart/form-data">
                                    @csrf
                                    <div class="row">
                                        <div class="col-12 mb-3">
                                            <h6 class="w-100" style="border-bottom:1px solid #999;">
                                                <div class="bg-gradient-dark m-white badge bg-dark"
                                                    style="width:20px;height:20px;border-radius:10px;display:inline-block;padding-top:3px;padding-left:7px;">
                                                    1</div> Student Information <span style="font-size:12px;"
                                                    class="f-right"></span>
                                            </h6>

                                        </div>
                                        <br>
                                        <div class="col-12 col-sm-4">
                                            <div class="form-group local-forms">
                                                <label class="text-dark">Student Name <span
                                                        class="login-danger">*</span></label>
                                                <input type="text" class="form-control" name="name"
                                                    value="{{ $student->name }}" placeholder="Enter Student Name">
                                                @error('name')
                                                    <p class="text-danger">{{ $message }}</p>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-12 col-sm-4">
                                            <div class="form-group local-forms">
                                                <label class="text-dark">Gender <span
                                                        class="login-danger">*</span></label>
                                                <select class="form-control select2" name="gender">
                                                    <option value="">Select Gender</option>
                                                    <option value="Male"
                                                        {{ $student->gender == 'Male' ? 'selected' : '' }}>Male</option>
                                                    <option value="Female"
                                                        {{ $student->gender == 'Female' ? 'selected' : '' }}>Female
                                                    </option>
                                                </select>

                                                @error('gender')
                                                    <p class="text-danger">{{ $message }}</p>
                                                @enderror

                                            </div>
                                        </div>
                                        <div class="col-12 col-sm-4">
                                            <div class="form-group local-forms ">
                                                <label class="text-dark">Date Of Birth <span
                                                        class="login-danger">*</span></label>
                                                <input class="form-control" type="date" name="dob"
                                                    value="{{ $student->dob }}">
                                                @error('dob')
                                                    <p class="text-danger">{{ $message }}</p>
                                                @enderror
                                            </div>
                                        </div>


                                        <div class="col-12 col-sm-4">
                                            <div class="form-group local-forms">
                                                <label class="text-dark">Monthly Payment Amount <span
                                                        class="login-danger">*</span></label>
                                                <input class="form-control" type="number" name="monthly_payment_amount"
                                                    placeholder="Enter Monthly Payment Amount"
                                                    value="{{ $student->monthly_payment_amount }}">
                                                @error('monthly_payment_amount')
                                                    <p class="text-danger">{{ $message }}</p>
                                                @enderror
                                            </div>
                                        </div>

                                        <div class="col-12 col-sm-4">
                                            <div class="form-group local-forms">
                                                <label class="text-dark">Blood Group </label>
                                                <select class="form-control select2" name="blood_group">
                                                    <option value="">Select Blood Group</option>
                                                    <option value="A+"
                                                        {{ $student->blood_group == 'A+' ? 'selected' : '' }}>A+
                                                    </option>
                                                    <option value="A-"
                                                        {{ $student->blood_group == 'A-' ? 'selected' : '' }}>A-
                                                    </option>
                                                    <option value="B+"
                                                        {{ $student->blood_group == 'B+' ? 'selected' : '' }}>B+
                                                    </option>
                                                    <option value="B-"
                                                        {{ $student->blood_group == 'B-' ? 'selected' : '' }}>B-
                                                    </option>
                                                    <option value="O+"
                                                        {{ $student->blood_group == 'O+' ? 'selected' : '' }}>O+
                                                    </option>
                                                    <option value="O-"
                                                        {{ $student->blood_group == 'O-' ? 'selected' : '' }}>O-
                                                    </option>
                                                    <option value="AB+"
                                                        {{ $student->blood_group == 'AB+' ? 'selected' : '' }}>AB+
                                                    </option>
                                                    <option value="AB-"
                                                        {{ $student->blood_group == 'AB-' ? 'selected' : '' }}>AB-
                                                    </option>
                                                </select>


                                            </div>
                                        </div>



                                        <div class="col-12 col-sm-4">
                                            <div class="form-group local-forms">
                                                <label class="text-dark">Disease If Any? </label>
                                                <input class="form-control" type="text" name="disease_if_any"
                                                    placeholder="Enter Disease Name If Any?" value="{{ $student->disease_if_any }}">
                                                @error('disease_if_any')
                                                    <p class="text-danger">{{ $message }}</p>
                                                @enderror
                                            </div>
                                        </div>

                                         <div class="col-12 col-sm-4">
                                            <div class="form-group local-forms">
                                                <label class="text-dark">Roll No </label>
                                                <input class="form-control" type="text" name="rollnumber"
                                                    placeholder="Enter Student Roll No" value="{{ $student->roll_number }}">
                                                @error('rollnumber')
                                                    <p class="text-danger">{{ $message }}</p>
                                                @enderror
                                            </div>
                                        </div>

                                        <div class="col-12 col-sm-4">
                                            <div class="form-group local-forms">
                                                <label class="text-dark">Profile Image </label>
                                                <input class="form-control" type="file" name="profile_image">
                                                @error('profile_image')
                                                    <p class="text-danger">{{ $message }}</p>
                                                @enderror
                                            </div>
                                        </div>

                                        <div class="col-12 mb-3">
                                            <h6 class="w-100" style="border-bottom:1px solid #999;">
                                                <div class="bg-gradient-dark m-white badge bg-dark"
                                                    style="width:20px;height:20px;border-radius:10px;display:inline-block;padding-top:3px;padding-left:7px;">
                                                    2</div> Guardian Information <span style="font-size:12px;"
                                                    class="f-right"></span>
                                            </h6>
                                        </div>

                                        <div class="col-12 col-sm-4">
                                            <div class="form-group local-forms">
                                                <label class="text-dark">Guardian Name <span
                                                        class="login-danger">*</span></label>
                                                <input type="text" class="form-control" name="guardian_name"
                                                    placeholder="Enter Guardian Name" value="{{ $student->guardian_name }}">
                                                @error('guardian_name')
                                                    <p class="text-danger">{{ $message }}</p>
                                                @enderror
                                            </div>
                                        </div>




                                        <div class="col-12 col-sm-4">
                                            <div class="form-group local-forms">
                                                <label class="text-dark">Guardian Email <span
                                                        class="login-danger">*</span></label>
                                                <input type="email" class="form-control" name="email" value="{{ $student->email }}"
                                                    placeholder="Enter Email">
                                                @error('email')
                                                    <p class="text-danger">{{ $message }}</p>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-12 col-sm-4">
                                            <div class="form-group local-forms">
                                                <label class="text-dark">Guardian Mobile <span
                                                        class="login-danger">*</span></label>
                                                <input type="number" class="form-control" placeholder="Enter Phone" value="{{ $student->mobile_no }}"
                                                    name="mobile_no">
                                                @error('mobile_no')
                                                    <p class="text-danger">{{ $message }}</p>
                                                @enderror
                                            </div>
                                        </div>

                                        <div class="col-12 col-sm-4">
                                            <div class="form-group local-forms">
                                                <label class="text-dark">Guardian Occupation </label>
                                                <input type="text" class="form-control" name="guardian_occupation" value="{{ $student->guardian_occupation }}"
                                                    placeholder="Enter Guardiuan Occupation">
                                                @error('guardian_occupation')
                                                    <p class="text-danger">{{ $message }}</p>
                                                @enderror
                                            </div>
                                        </div>

                                        <div class="col-12 mb-3">
                                            <h6 class="w-100" style="border-bottom:1px solid #999;">
                                                <div class="bg-gradient-dark m-white badge bg-dark"
                                                    style="width:20px;height:20px;border-radius:10px;display:inline-block;padding-top:3px;padding-left:7px;">
                                                    3</div> Other Information <span style="font-size:12px;"
                                                    class="f-right"></span>
                                            </h6>
                                        </div>

                                        <div class="col-12 col-sm-4">
                                            <div class="form-group local-forms">
                                                <label class="text-dark">Home Address <span
                                                        class="login-danger">*</span></label>
                                                <input class="form-control" type="text" name="address" value="{{ $student->address }}"
                                                    placeholder="Enter Home Address">
                                                @error('address')
                                                    <p class="text-danger">{{ $message }}</p>
                                                @enderror
                                            </div>
                                        </div>

                                        <div class="col-12 col-sm-4">
                                            <div class="form-group local-forms">
                                                <label class="text-dark">Previous School </label>
                                                <input class="form-control" type="text" name="previous_school" value="{{ $student->previous_school }}"
                                                    placeholder="Enter Previous School Name">
                                                @error('previous_school')
                                                    <p class="text-danger">{{ $message }}</p>
                                                @enderror
                                            </div>
                                        </div>



                                        <div class="col-12 mt-4">
                                            <div class="student-submit" style="display: flex; gap: 10px;">
                                                <button type="reset" class="btn btn-primary"
                                                    style="display: flex; align-items: center; justify-content: center; font-family: 'Poppins', sans-serif; font-size: 14px; font-weight: 600; color: white;">
                                                    <i class='bx bx-reset bx-sm' style="margin-right: 5px;"></i> Reset
                                                </button>
                                                <button type="submit" class="btn btn-primary"
                                                    style="display: flex; align-items: center; justify-content: center; font-family: 'Poppins', sans-serif; font-size: 14px; font-weight: 600; color: white;">
                                                    <i class='bx bx-check bx-sm' style="margin-right: 5px;"></i>
                                                    Submit
                                                </button>
                                            </div>

                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>




        <script src="https://nepalidatepicker.sajanmaharjan.com.np/nepali.datepicker/js/nepali.datepicker.v4.0.1.min.js"
            type="text/javascript"></script>
        <script type="text/javascript">
            window.onload = function() {
                var mainInput = document.getElementById("nepali-datepicker");
                mainInput.nepaliDatePicker();
            };
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
