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

<body>

    <div class="main-wrapper">

        @include('admin_layouts.nav')


        @include('admin_layouts.sidebar')


        <div class="page-wrapper">
            <div class="content container-fluid">

                <div class="page-header">
                    <div class="row align-items-center">
                        <div class="col">
                            <h3 class="page-title">Add New Class</h3>
                            <ul class="breadcrumb">
                                <li class="breadcrumb-item"><a href="{{url('admin/school-classes')}}">School Class</a></li>
                                <li class="breadcrumb-item active">Add Class</li>
                            </ul>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-sm-12">
                        <div class="card">
                            <div class="card-body">
                                <form action="{{ url('admin/teachers/add') }}" method="POST"
                                    enctype="multipart/form-data">
                                    @csrf
                                    <div class="mt-3 row">
                                      
                                        <div class=" col-12 col-sm-4">
                                            <div class="form-group local-forms">
                                                <label>School Class <span class="login-danger">*</span></label>
                                                <input type="text" class="form-control" name="teacher_name"
                                                    placeholder="Enter Class Name">
                                                @error('teacher_name')
                                                    <p class="text-danger">{{ $message }}</p>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-12 col-sm-4">
                                            <div class="form-group local-forms">
                                                <label>Gender <span class="login-danger">*</span></label>
                                                <select class="form-control select2" name="gender" style="height: 38px;">
                                                  @foreach ($teachers as $teacher)
                                                      <option>{{$teacher->teacher_name}}</option>
                                                  @endforeach
                                                </select>

                                            </div>
                                        </div>
                                        

                                        

                                        <div class="col-12 mt-4">
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
            </div>
        </div>

<style>
   
    .select2-container--default .select2-selection--single {
        height: 40px; 
        line-height: 38px; 
    }

    .select2-container--default .select2-selection--single .select2-selection__rendered {
        padding-right: 28px; 
    }

    .select2-container--default .select2-selection--single .select2-selection__arrow {
        height: 38px; 
    }

    .select2-container--default .select2-selection--single .select2-selection__rendered {
        line-height: 40px; 
    }

    
</style>

<script>
  $(document).ready(function() {
    $('.select2').select2();
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
