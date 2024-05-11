<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0">
    <title>Pragyan Montessori System Login</title>
    <meta name="author" content="Hancie Phago">
    <link rel="icon" href="{{ url('assets/img/logo.ico') }}" type="image/x-icon">
    <x-meta title="Pragyani Montessori & Childcare Center - Login"
        description="Discover a nurturing learning environment for your child at Pragyani 
            Montessori & Childcare Center, conveniently located on Pragati Sangam Marg in New Naikap,
             Chandragiri 14, Kathmandu. "
        image="{{ url('assets/img/logo.jpg') }}" />

    <link rel="shortcut icon" href="assets/img/favicon.png">
    <link rel="stylesheet" href="{{ url('assets/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ url('assets/css/feather.css') }}">
    <link rel="stylesheet" href="{{ url('assets/css/flags.css') }}">
    <link rel="stylesheet" href="{{ url('assets/css/fontawesome.min.css') }}">
    <link rel="stylesheet" href="{{ url('assets/css/all.min.css') }}">
    <link rel="stylesheet" href="{{ url('assets/css/style.css') }}">
</head>

<body>

    <div class="main-wrapper login-body">
        <div class="login-wrapper">
            <div class="container">
                <div class="loginbox">
                    <div class="login-left">
                        <img class="img-fluid" src="{{ url('assets/img/login.png') }}" alt="Logo">
                    </div>
                    <div class="login-right">
                        <div class="login-right-wrap">

                            <h1>Enter New Password</h1>
                            <p class="account-subtitle">Let Us Help You</p>

                            <form action="{{ url('/complete_registration') }}" method="post">
                                @csrf
                                <input type="hidden" value="{{ request()->query('token') }}" class="form-control"
                                    name="token" />
                                <div class="form-group">
                                    <label>Enter your new password <span class="login-danger">*</span></label>
                                    <input class="form-control pass-input" type="password" name="password">
                                    <span class="profile-views feather-eye toggle-password"></span>
                                    @error('password')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <button class="btn btn-primary btn-block" type="submit">Confirm My
                                        Password</button>
                                </div>
                                
                                </div>
                            </form>



                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <script src="{{ url('assets/js/jquery-3.7.1.min.js') }}"></script>

    <script src="{{ url('assets/js/bootstrap.bundle.min.js') }}"></script>

    <script src="{{ url('assets/js/feather.min.js') }}"></script>

    <script src="{{ url('assets/js/script.js') }}"></script>


</body>

</html>
