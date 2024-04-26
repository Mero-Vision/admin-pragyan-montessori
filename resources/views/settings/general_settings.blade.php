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
                    <div class="row">
                        <div class="col">
                            <h3 class="page-title">@lang('translation.setting')</h3>
                            <ul class="breadcrumb">
                                <li class="breadcrumb-item"><a href="{{url('admin/settings/general-settings')}}">@lang('translation.setting')</a></li>
                                <li class="breadcrumb-item active">General Settings</li>
                            </ul>
                        </div>
                    </div>
                </div>

                <div class="settings-menu-links">
                    <ul class="nav nav-tabs menu-tabs">
                        <li class="nav-item active">
                            <a class="nav-link" href="{{ url('admin/settings/general-settings') }}">General Settings</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ url('admin/settings/social-links-settings') }}">Social
                                Links</a>
                        </li>

                    </ul>
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <div class="card">
                            <div class="card-header">
                                <h5 class="card-title">School Basic Details</h5>
                            </div>
                            <div class="card-body pt-0">
                                <form action="{{url('admin/settings/site-settings')}}" method="POST">
                                    @csrf
                                    <div class="settings-form">
                                        <div class="form-group">
                                            <label>School Name <span class="star-red">*</span></label>
                                            @if (isset($data['school_name']))
                                                <input type="text" value="{{ $data['school_name'] }}"
                                                    class="form-control" name="school_name" />
                                            @else
                                                <input type="text" class="form-control" name="school_name" />
                                            @endif
                                        </div>



                                        <div class="form-group mb-0">
                                            <div class="settings-btns">
                                                <button type="submit" class="btn btn-orange">Update</button>
                                               
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="card">
                            <div class="card-header">
                                <h5 class="card-title">Address Details</h5>
                            </div>
                            <div class="card-body pt-0">
                                <form action="{{url('admin/settings/site-settings')}}" method="POST">
                                    @csrf
                                    <div class="settings-form">
                                        <div class="form-group">
                                            <label>Phone No <span class="star-red">*</span></label>
                                             @if (isset($data['phone_no']))
                                                <input type="text" value="{{ $data['phone_no'] }}"
                                                    class="form-control" name="phone_no" />
                                            @else
                                                <input type="text" class="form-control" name="phone_no" placeholder="Enter Mobile No"/>
                                            @endif
                                           
                                        </div>
                                        <div class="form-group">
                                            <label>Email <span class="star-red">*</span></label>

                                            @if (isset($data['email']))
                                                <input type="text" value="{{ $data['email'] }}"
                                                    class="form-control" name="email" />
                                            @else
                                                <input type="text" class="form-control" name="email"  placeholder="Enter Email"/>
                                            @endif
                                           
                                        </div>
                                        <div class="form-group">
                                            <label>Address <span class="star-red">*</span></label>

                                              @if (isset($data['address']))
                                                <input type="text" value="{{ $data['address'] }}"
                                                    class="form-control" name="address" />
                                            @else
                                                <input type="text" class="form-control" name="address"   placeholder="Enter Address"/>
                                            @endif

                                            
                                        </div>

                                        
                                        <div class="form-group mb-0">
                                            <div class="settings-btns">
                                                <button type="submit" class="btn btn-orange">Update</button>
                                               
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
