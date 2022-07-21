<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Login - NB</title>
    <!-- Favicon -->
    <link rel="shortcut icon" href="{{asset('assets/images/nb-logo.png')}}" />
    <link rel="stylesheet" href="{{asset('assets/css/hope-ui.min.css')}}" />
    <link rel="stylesheet" type="text/css" href="{{asset('assets/css/style.css')}}">
</head>
<div id="preloader"></div>
<body>
<section>
    <div class="container-fluid">
        <div class="row justify-content-center g-3">
            <div class="col-12 col-sm-12 col-md-12 col-lg-6 col-xl-6 col-xxl-6 login_left_side pb-5 bg-transparent">
                <div class="login_left_side_iner p-3">
                    <div class="row">
                        <div class="col-12 col-sm-12 col-md-12 col-xl-12 col-xxl-12">
                            <div class="d-lg-flex d-xl-flex text-center align-items-center">
                                <div class="login_img_div ms-3">
                                    <img src="{{asset('assets/images/nb-logo.png')}}" class="img-fluid">
                                </div>
                                <h2 class="ms-2 login_heading fw-bold">Nigerian Insurers Association</h2>
                            </div>
                            <div class="login_img2_div">
                                <img src="{{asset('assets/images/logincard.png')}}" class="img-fluid w-100">
                                <p class="login_right_side_card_para mb-0 text-center fs-4 px-5"></p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @yield('content')
        </div>
    </div>
</section>
<!-- Library Bundle Script -->
<script src="{{asset('assets/js/libs.min.js')}}"></script>
<!-- Lodash Utility -->
<script src="{{asset('assets/js/lodash.min.js')}}"></script>
<!-- Utilities Functions -->
<script src="{{asset('assets/js/utility.min.js')}}"></script>
<!-- Settings Script -->
<script src="{{asset('assets/js/setting.min.js')}}"></script>
<!-- Settings Init Script -->
<!-- External Library Bundle Script -->
<script src="{{asset('assets/js/external.min.js')}}"></script>
<!-- Dashboard Script -->
<script src="{{asset('assets/js/dashboard.js')}}" defer></script>
<!-- Hopeui Script -->
<script src="{{asset('assets/js/hope-ui.js')}}" defer></script>
<script src="{{asset('assets/js/hope-uipro.js')}}" defer></script>
</body>
</html>
