<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0">
    <title>Holy Field English School - Login</title>

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
                        <img class="img-fluid" src="{{url('assets/img/login.png')}}" alt="Logo">
                    </div>
                    <div class="login-right">
                        <div class="login-right-wrap">
                            <h1>Holy Field School</h1>
                            <h2 class="mt-3">Sign in</h2>

                            <form action="{{url('login')}}" method="POST">
                                @csrf
                                <div class="form-group mb-0">
                                    <label>Email <span class="login-danger">*</span></label>
                                    <input class="form-control" type="text" name="email">
                                    <span class="profile-views"><i class="fas fa-user-circle"></i></span>
                                   
                                </div>
                                 @error('email')
                                        <p class="text-danger">{{$message}}</p>
                                    @enderror
                                <div class="form-group mt-4 mb-0">
                                    <label>Password <span class="login-danger">*</span></label>
                                    <input class="form-control pass-input" type="text" name="password">
                                    <span class="profile-views feather-eye toggle-password"></span>
                                    
                                </div>
                                 @error('password')
                                        <p class="text-danger">{{$message}}</p>
                                    @enderror
                                <div class="forgotpass mt-2">
                                    <div class="remember-me">
                                        <label class="custom_check mr-2 mb-0 d-inline-flex remember-me"> Remember me
                                            <input type="checkbox" name="radio">
                                            <span class="checkmark"></span>
                                        </label>
                                    </div>
                                    <a href="#">Forgot Password?</a>
                                </div>
                                <div class="form-group">
                                    <button class="btn btn-primary btn-block" type="submit">Login</button>
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
