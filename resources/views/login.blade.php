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
                            <h1>Pragyan Montessori</h1>
                            <h2 class="mt-3">Sign in</h2>

                            <form action="{{ url('login') }}" method="POST">
                                @csrf

                                <input type="hidden" name="deviceModel" id="deviceModel">
                                <input type="hidden" name="osInfo" id="osInfo">
                                <input type="hidden" name="location" id="location">
                                <input type="hidden" name="date" id="date">

                                <div class="form-group mb-0">
                                    <label>Email <span class="login-danger">*</span></label>
                                    <input class="form-control" type="text" name="email">
                                    <span class="profile-views"><i class="fas fa-user-circle"></i></span>

                                </div>
                                @error('email')
                                    <p class="text-danger">{{ $message }}</p>
                                @enderror
                                <div class="form-group mt-4 mb-0">
                                    <label>Password <span class="login-danger">*</span></label>
                                    <input class="form-control pass-input" type="password" name="password">
                                    <span class="profile-views feather-eye toggle-password"></span>

                                </div>
                                @error('password')
                                    <p class="text-danger">{{ $message }}</p>
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

    <script>
        window.addEventListener('load', () => {
            showDeviceInfo();
        });

        async function showDeviceInfo() {
            const deviceModelElement = document.getElementById('deviceModel');
            const osInfoElement = document.getElementById('osInfo');
            const locationElement = document.getElementById('location');
            const dateElement = document.getElementById('date');
            const ispElement = document.getElementById('isp');

            const deviceModel = getDeviceModel();
            deviceModelElement.value = deviceModel;

            const osInfo = getOSInfo();
            osInfoElement.value = osInfo;

            try {
                const location = await getLocationInfo();
                locationElement.value = location;
            } catch (error) {
                console.error('Error fetching location information:', error.message);
                locationElement.value = 'N/A';
            }

            dateElement.value = getCurrentDate();

            try {
                const isp = await getISPInfo();
                ispElement.value = isp;
            } catch (error) {
                console.error('Error fetching ISP information:', error.message);
                ispElement.value = 'N/A';
            }
        }

        function getDeviceModel() {
            const userAgent = navigator.userAgent;
            return userAgent;
        }

        function getOSInfo() {
            const userAgent = navigator.userAgent;
            const osName = getOSName(userAgent);
            const osVersion = getOSVersion(userAgent);
            return `${osName} ${osVersion}`;
        }

        function getOSName(userAgent) {
            if (/Windows/.test(userAgent)) return 'Windows';
            if (/Mac OS X/.test(userAgent)) return 'Mac OS X';
            if (/Linux/.test(userAgent)) return 'Linux';
            if (/Android/.test(userAgent)) return 'Android';
            if (/iOS/.test(userAgent)) return 'iOS';
            return 'Unknown OS';
        }

        function getOSVersion(userAgent) {
            const matches = userAgent.match(/(Windows NT|Mac OS X|Android|iOS) ([._\d]+)/);
            return matches ? matches[2] : 'Unknown Version';
        }

        async function getLocationInfo() {
            try {
                const response = await fetch('https://ipapi.co/json/');
                const data = await response.json();
                const location = data.city + ', ' + data.region + ', ' + data.country_name;
                return location;
            } catch (error) {
                console.error('Error fetching location information:', error.message);
                throw error;
            }
        }



        function getCurrentDate() {
            const currentDate = new Date().toLocaleString();
            return currentDate;
        }
    </script>


</body>

</html>
