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
                            <h3 class="page-title">Settings</h3>
                            <ul class="breadcrumb">
                                <li class="breadcrumb-item"><a href="{{url('admin/settings/general-settings')}}">Settings</a></li>
                                <li class="breadcrumb-item active">Social Links</li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-12">

                        <div class="settings-menu-links">
                            <ul class="nav nav-tabs menu-tabs">
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ url('admin/settings/general-settings') }}">General
                                        Settings</a>
                                </li>
                               

                                <li class="nav-item active">
                                    <a class="nav-link" href="{{ url('admin/settings/social-links-settings') }}">Social
                                        Links</a>
                                </li>
                            </ul>
                        </div>

                        <div class="row">
                            <div class="col-lg-6 col-md-8">
                                <div class="card">
                                    <div class="card-header">
                                        <h5 class="card-title">Social Link Settings</h5>
                                    </div>
                                    <div class="card-body pt-0">
                                        <form action="{{ url('admin/settings/site-settings') }}" method="POST">
                                            @csrf
                                            <div class="settings-form">
                                                <div class="links-info">
                                                    <div class="row form-row links-cont">
                                                        <div class="form-group form-placeholder d-flex">
                                                            <button class="btn social-icon">
                                                                <i class="feather-facebook"></i>
                                                            </button>
                                                            @if (isset($data['facebook_link']))
                                                                <input type="text"
                                                                    value="{{ $data['facebook_link'] }}"
                                                                    class="form-control" name="facebook_link" />
                                                            @else
                                                                <input type="text" class="form-control"
                                                                    placeholder="https://www.facebook.com"
                                                                    name="facebook_link" />
                                                            @endif


                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="links-info">
                                                    <div class="row form-row links-cont">
                                                        <div class="form-group form-placeholder d-flex">
                                                            <button class="btn social-icon">
                                                                <i class="feather-twitter"></i>
                                                            </button>
                                                            @if (isset($data['twitter_link']))
                                                                <input type="text"
                                                                    value="{{ $data['twitter_link'] }}"
                                                                    class="form-control" name="twitter_link" />
                                                            @else
                                                                <input type="text" class="form-control"
                                                                    placeholder="https://www.twitter.com"
                                                                    name="twitter_link" />
                                                            @endif


                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="links-info">
                                                    <div class="row form-row links-cont">
                                                        <div class="form-group form-placeholder d-flex">
                                                            <button class="btn social-icon">
                                                                <i class="feather-youtube"></i>
                                                            </button>
                                                             @if (isset($data['youtube_link']))
                                                                <input type="text"
                                                                    value="{{ $data['youtube_link'] }}"
                                                                    class="form-control" name="youtube_link" />
                                                            @else
                                                                <input type="text" class="form-control"
                                                                   placeholder="https://www.youtube.com"
                                                                    name="youtube_link" />
                                                            @endif
                                                           

                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="links-info">
                                                    <div class="row form-row links-cont">
                                                        <div class="form-group form-placeholder d-flex">
                                                            <button class="btn social-icon">
                                                                <i class="feather-instagram"></i>
                                                            </button>
                                                            @if (isset($data['instagram_link']))
                                                                <input type="text"
                                                                    value="{{ $data['instagram_link'] }}"
                                                                    class="form-control" name="instagram_link" />
                                                            @else
                                                                <input type="text" class="form-control"
                                                                   placeholder="https://www.instagram.com/"
                                                                    name="instagram_link" />
                                                            @endif

                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            {{-- <div class="form-group">
                                                <a href="javascript:void(0);" class="btn add-links">
                                                    <i class="fas fa-plus me-1"></i> Add More
                                                </a>
                                            </div> --}}
                                            <div class="form-group mb-0">
                                                <div class="settings-btns">
                                                    <button type="submit" class="btn btn-orange">Submit</button>

                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
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
