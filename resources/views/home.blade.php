<!doctype html>
<html lang="en" dir="ltr">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>@yield('title')</title>
    <!-- Favicon -->
    <link rel="shortcut icon" href="{{asset('assets/images/nb-logo.png')}}"/>
    <!-- Library / Plugin Css Build -->
    <link rel="stylesheet" href="{{asset('assets/css/libs.min.css')}}"/>
    <!-- Hope Ui Design System Css -->
    <link rel="stylesheet" href="{{asset('assets/css/hope-ui.min.css')}}"/>
    <link rel="stylesheet" href="{{asset('assets/css/pro.min.css')}}"/>
    <!-- Custom Css -->
    <link rel="stylesheet" href="{{asset('assets/css/custom.min.css')}}"/>
    <!-- Customizer Css -->
    <link rel="stylesheet" href="{{asset('assets/css/customizer.min.css')}}"/>
    <!-- Google Font -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/fontawesome.min.css"/>
    <link rel="stylesheet" type="text/css" href="{{asset('assets/css/style.css')}}">
</head>
<div id="preloader"></div>
<body>


<div class="fixed-top w-100 bg-white p-2">
    <div class="container-fluid">
        <div class="row d-none d-lg-flex d-xl-flex align-items-start">
            <div class="col-lg-6">
                <div>
                    <a href="{{url('/')}}" class="navbar-brand d-flex align-items-center">
                        <!--Logo start-->
                        <div class="logo-main">
                            <div class="logo-normal">
                                <img src="{{asset('assets/images/nb-logo.png')}}" class="img-fluid"
                                     style="width: 70px;">
                            </div>
                        </div>
                        <!--logo End-->
                        <h4 class="logo-title">Nigerian Insurers Association</h4>
                    </a>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="pt-3">
                    <ul class="navbar-nav flex-row justify-content-end ms-auto align-items-center navbar-list mb-lg-0">

                        <li class="nav-item dropdown pe-3 d-none d-xl-block">
                            <div class="form-group input-group mb-0 search-input border-radius-20">
                                    <span class="input-group-text  border-end-0 border-radius-icon-20">
                                     <svg class="icon-20" width="20" height="20" viewBox="0 0 24 24" fill="none"
                                          xmlns="http://www.w3.org/2000/svg">
                                        <circle cx="11.7669" cy="11.7666" r="8.98856" stroke="currentColor"
                                                stroke-width="1.5" stroke-linecap="round"
                                                stroke-linejoin="round"></circle>
                                        <path d="M18.0186 18.4851L21.5426 22" stroke="currentColor" stroke-width="1.5"
                                              stroke-linecap="round" stroke-linejoin="round"></path>
                                     </svg>
                                    </span>
                                <input type="text" class="form-control border-radius-input-20 border-start-0"
                                       placeholder="Search...">
                            </div>
                        </li>
                        <li class="nav-item dropdown ms-3 " id="itemdropdown1">
                            <a class="py-0 nav-link d-flex align-items-center" href="#" id="navbarDropdown"
                               role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                <div class="btn btn-primary btn-icon btn-sm rounded-pill overflow-hidden border-0">
                                     <span class="btn-inner  rounded-pill">
                                        <img src="{{loginUserImage()}}" class="img-fluid">
                                     </span>
                                </div>
                                <div class="ms-2">
                                    <h6 class="text-dark text-capitalize mb-0">{{ loginUserName() }}</h6>
                                    <p class="text-capitalize mb-0">Admin</p>
                                </div>
                                <div class="more-arrow-size ms-2">
                                    <img src="{{asset('assets/images/more.png')}}" class="img-fluid">
                                </div>
                            </a>
                            <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                                <li>
                                    <a class="dropdown-item" href="{{ url('/settings') }}">Profile</a>
                                </li>
                                {{--<li>--}}
                                {{--<a class="dropdown-item" href="#">Privacy Setting</a>--}}
                                {{--</li>--}}
                                <li>
                                    <hr class="dropdown-divider">
                                </li>
                                <li>
                                    <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault();
                                        document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}</a>
                                </li>
                            </ul>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>

<aside class="sidebar sidebar-default left-bordered top-90" id="first-tour" data-toggle="main-sidebar"
       data-sidebar="responsive">
    <div class="sidebar-header d-flex align-items-center justify-content-start ">
        <a href="{{url('/dashboard')}}" class="navbar-brand d-block d-xl-none d-lg-none">
            <!--Logo start-->
            <div class="logo-main">
                <div class="logo-normal">
                    <img src="{{asset('assets/images/nb-logo.png')}}" class="img-fluid w-75">
                </div>
                <div class="logo-mini">
                    <img src="{{asset('assets/images/nb-logo.png')}}" style="width:40px;">
                </div>
            </div>
            <!--logo End-->
            <h4 class="logo-title" data-setting="app_name">Nigerian Insurers Association</h4>
        </a>
        <div class="sidebar-toggle" data-toggle="sidebar" data-active="true" onclick="slideopen();">
            <i class="icon">
                <svg class="icon-20" width="20" height="20" viewBox="0 0 24 24" fill="none"
                     xmlns="http://www.w3.org/2000/svg">
                    <path d="M4.25 12.2744L19.25 12.2744" stroke="currentColor" stroke-width="1.5"
                          stroke-linecap="round" stroke-linejoin="round"></path>
                    <path d="M10.2998 18.2988L4.2498 12.2748L10.2998 6.24976" stroke="currentColor" stroke-width="1.5"
                          stroke-linecap="round" stroke-linejoin="round"></path>
                </svg>
            </i>
        </div>
    </div>
    <div class="sidebar-body pt-0 data-scrollbar">
        <div class="sidebar-list">
            <!-- Sidebar Menu Start -->
            <ul class="navbar-nav iq-main-menu w75vh" id="sidebar-menu">
                <li class="nav-item">
                    <a class="nav-link @if(url()->current() == url('dashboard')) active @endif" aria-current="page"
                       href="{{url('/dashboard')}}">
                        <i class="icon w-20s" id="iconDisplay" data-bs-toggle="tooltip" title="Dashboard"
                           data-bs-placement="right">
                            <img
                                src="@if(url()->current() == url('dashboard')) {{ asset('assets/images/dashboard.png') }} @else {{asset('assets/images/dashboard-dark.png')}} @endif"
                                class="img-fluid">
                        </i>
                        <span class="item-name">File</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link @if(url()->current() == url('report')) active @endif" aria-current="page"
                       href="{{ url('/report') }}">
                        <i class="icon w-20s" id="iconDisplay1" data-bs-toggle="tooltip" title="Chat"
                           data-bs-placement="right">
                            <img
                                src="@if(url()->current() == url('report')) {{ asset('assets/images/report-white.png') }} @else {{asset('assets/images/report.svg')}} @endif"
                                class="img-fluid">
                        </i>
                        <span class="text-capitalize">report</span>
                    </a>
                </li>
                <li class="nav-item @if(isAdmin() == false) d-none @endif">
                    <a class="nav-link @if(url()->current() == url('uploads')) active @endif"
                       href="{{ url('/uploads') }}">
                        <i class="icon w-20s" id="iconDisplay2">
                            <img
                                src="@if(url()->current() == url('uploads')) {{ asset('assets/images/upload-white.png') }} @else {{asset('assets/images/upload.png')}} @endif"
                                class="img-fluid">
                        </i>
                        <span class="text-capitalize">uploads</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link @if(url()->current() == url('audit/trail')) active @endif"
                       href="{{ url('/audit/trail') }}">
                        <i class="icon w-20s" id="iconDisplay3">
                            <img
                                src="@if(url()->current() == url('audit/trail')) {{ asset('assets/images/audit-white.png') }} @else {{asset('assets/images/audit.png')}} @endif"
                                class="img-fluid">
                        </i>
                        <span class="text-capitalize">audit trail</span>
                    </a>
                </li>
                <li class="nav-item d-none">
                    <a class="nav-link @if(url()->current() == url('files')) active @endif" href="{{ url('/files') }}">
                        <i class="icon w-20s" id="iconDisplay4">
                            <img
                                src="@if(url()->current() == url('files')) {{ asset('assets/images/myfile-white.png') }} @else {{asset('assets/images/myfile.png')}} @endif"
                                class="img-fluid">
                        </i>
                        <span class="text-capitalize">my files</span>
                    </a>
                </li>

                @if(!isCompanyUser())
                    <li class="nav-item">
                        <a class="nav-link @if(url()->current() == url('/user') || url()->current() == url('/user/create')) active @endif"
                           href="{{ url('/user') }}">
                            <i class="fa-solid fa-user icon @if(url()->current() == url('/user') || url()->current() == url('/user/create')) text-white @else text-success @endif"></i>
                            <span class="text-capitalize">User Management</span>
                        </a>
                    </li>
                @endif

                <li class="nav-item">
                    <a class="nav-link @if(url()->current() == url('settings')) active @endif"
                       href="{{ url('/settings') }}">
                        <i class="icon w-20s" id="">
                            <img
                                src="@if(url()->current() == url('settings')) {{ asset('assets/images/setting-white.png') }} @else {{asset('assets/images/setting.png')}} @endif"
                                class="img-fluid">
                        </i>
                        <span class="text-capitalize">profile</span>
                    </a>
                </li>
            </ul>
            <!-- Sidebar Menu End -->

            <div>
                <div class="row">
                    <div class="col-lg-12">
                        <div class="d-flex align-items-center justify-content-center mb-4">
                            <div>
                                <img src="{{asset('assets/images/turn-off.png')}}" class="img-fluid w-20s">
                            </div>
                            <a class="text-capitalize text-danger ms-3" id="logout"
                               href="{{ route('logout') }}" onclick="event.preventDefault();
                                document.getElementById('logout-form').submit();">
                                {{ __('Logout') }}
                            </a>
                        </div>
                    </div>
                    <div class="col-lg-12">
                        <div class="text-center" id="text-designer">
                            <p class="text-muted">

                            </p>
                            <p class="text-danger">

                            </p>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
    <div class="sidebar-footer"></div>
</aside>
<main class="main-content mt-5">
    <div class="position-relative ">
        <!--Nav Start-->
        <nav class="nav navbar navbar-expand-xl navbar-light iq-navbar">
            <div class="container-fluid navbar-inner">
                <a href="{{ url('/dashboard') }}" class="navbar-brand">
                    <!--Logo start-->
                    <div class="logo-main">
                        <div class="logo-normal d-flex align-items-center">
                            <img src="{{asset('assets/images/nb-logo.png')}}" class="img-fluid width-100">
                            <div class="font-13">
                                Nigerian Insurers Association
                            </div>
                        </div>
                        <div class="logo-mini">
                            <img src="{{asset('assets/images/nb-logo.png')}}" class="img-fluid w-50">
                        </div>
                    </div>
                    <!--logo End-->
                </a>
                <div class="sidebar-toggle" data-toggle="sidebar" data-active="true">
                    <i class="icon d-flex">
                        <svg class="icon-20" width="20" viewBox="0 0 24 24">
                            <path fill="currentColor"
                                  d="M4,11V13H16L10.5,18.5L11.92,19.92L19.84,12L11.92,4.08L10.5,5.5L16,11H4Z"/>
                        </svg>
                    </i>
                </div>
                <div class="d-flex align-items-center">
                    <button id="navbar-toggle" class="navbar-toggler" type="button" data-bs-toggle="collapse"
                            data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                            aria-expanded="false" aria-label="Toggle navigation">
                            <span class="navbar-toggler-icon">
                                <span class="navbar-toggler-bar bar1 mt-1"></span>
                                <span class="navbar-toggler-bar bar2"></span>
                                <span class="navbar-toggler-bar bar3"></span>
                            </span>
                    </button>
                </div>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="mb-2 navbar-nav ms-auto align-items-center navbar-list mb-lg-0">
                        <li class="nav-item dropdown border-end pe-3 d-none d-xl-block">
                            <div class="form-group input-group mb-0 search-input">
                                    <span class="input-group-text">
                                        <svg class="icon-20" width="20" height="20" viewBox="0 0 24 24" fill="none"
                                             xmlns="http://www.w3.org/2000/svg">
                                            <circle cx="11.7669" cy="11.7666" r="8.98856" stroke="currentColor"
                                                    stroke-width="1.5" stroke-linecap="round"
                                                    stroke-linejoin="round"></circle>
                                            <path d="M18.0186 18.4851L21.5426 22" stroke="currentColor"
                                                  stroke-width="1.5" stroke-linecap="round"
                                                  stroke-linejoin="round"></path>
                                        </svg>
                                    </span>
                                <input type="text" class="form-control" placeholder="Search...">

                            </div>
                        </li>
                        <li class="nav-item dropdown iq-responsive-menu border-end d-block d-xl-none">
                            <div class="btn btn-sm bg-body" id="navbarDropdown-search-11" role="button"
                                 data-bs-toggle="dropdown" aria-expanded="false">
                                <svg class="icon-20" width="20" viewBox="0 0 24 24" fill="none"
                                     xmlns="http://www.w3.org/2000/svg">
                                    <circle cx="11.7669" cy="11.7666" r="8.98856" stroke="currentColor"
                                            stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></circle>
                                    <path d="M18.0186 18.4851L21.5426 22" stroke="currentColor" stroke-width="1.5"
                                          stroke-linecap="round" stroke-linejoin="round"></path>
                                </svg>
                            </div>
                            <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown-search-11"
                                style="width: 25rem;">
                                <li class="px-3 py-0">
                                    <div class="form-group input-group mb-0">
                                        <input type="text" class="form-control" placeholder="Search...">
                                        <span class="input-group-text">
                                                <svg class="icon-20" width="20" height="20" viewBox="0 0 24 24"
                                                     fill="none" xmlns="http://www.w3.org/2000/svg">
                                                    <circle cx="11.7669" cy="11.7666" r="8.98856" stroke="currentColor"
                                                            stroke-width="1.5" stroke-linecap="round"
                                                            stroke-linejoin="round"></circle>
                                                    <path d="M18.0186 18.4851L21.5426 22" stroke="currentColor"
                                                          stroke-width="1.5" stroke-linecap="round"
                                                          stroke-linejoin="round"></path>
                                                </svg>
                                            </span>
                                    </div>
                                </li>
                            </ul>
                        </li>
                        <li class="nav-item dropdown" id="itemdropdown1">
                            <a class="py-0 nav-link d-flex align-items-center" href="#" id="navbarDropdown"
                               role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                <div class="btn btn-primary btn-icon btn-sm rounded-pill">
                                        <span class="btn-inner">
                                            <svg class="icon-32" width="32" viewBox="0 0 24 24" fill="none"
                                                 xmlns="http://www.w3.org/2000/svg">
                                                <path
                                                    d="M11.997 15.1746C7.684 15.1746 4 15.8546 4 18.5746C4 21.2956 7.661 21.9996 11.997 21.9996C16.31 21.9996 19.994 21.3206 19.994 18.5996C19.994 15.8786 16.334 15.1746 11.997 15.1746Z"
                                                    fill="currentColor"></path>
                                                <path opacity="0.4"
                                                      d="M11.9971 12.5838C14.9351 12.5838 17.2891 10.2288 17.2891 7.29176C17.2891 4.35476 14.9351 1.99976 11.9971 1.99976C9.06008 1.99976 6.70508 4.35476 6.70508 7.29176C6.70508 10.2288 9.06008 12.5838 11.9971 12.5838Z"
                                                      fill="currentColor"></path>
                                            </svg>
                                        </span>
                                </div>
                            </a>
                            <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                                <li>
                                    <a class="dropdown-item" href="">Profile</a>
                                </li>
                                <li>
                                    <a class="dropdown-item" href="">Privacy Setting</a>
                                </li>
                                <li>
                                    <hr class="dropdown-divider">
                                </li>
                                <li>
                                    <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault();
                                        document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}</a>
                                </li>
                            </ul>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
        <!--Nav End-->
        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
            @csrf
        </form>
    </div>
@yield('content')
<!-- Footer Section Start -->
    <footer class="footer">
        <div class="footer-body">
            <div class="right-panel">
                ©
                <script>2022</script>
                <span class="text-gray">
                    </span> <a href="" target="_blank"></a>.
            </div>
        </div>
    </footer>
    <!-- Footer Section End -->
</main>


<!-- Library Bundle Script -->
<script src="{{asset('assets/js/libs.min.js')}}"></script>
<!-- Lodash Utility -->
<script src="{{asset('assets/js/lodash.min.js')}}"></script>
<!-- Utilities Functions -->
<script src="{{asset('assets/js/utility.min.js')}}"></script>
<!-- Settings Script -->
<script src="{{asset('assets/js/setting.min.js')}}"></script>
<!-- Settings Init Script -->
<script src="{{asset('assets/js/setting-init.js')}}"></script>
<!-- External Library Bundle Script -->
<script src="{{asset('assets/js/external.min.js')}}"></script>
<!-- Widgetchart Script -->
<script src="{{asset('assets/js/widgetcharts.js')}}" defer></script>
<!-- Dashboard Script -->
<script src="{{asset('assets/js/dashboard.js')}}" defer></script>
<!-- Hopeui Script -->
<script src="{{asset('assets/js/hope-ui.js')}}" defer></script>
<script src="{{asset('assets/js/hope-uipro.js')}}" defer></script>
<script src="{{asset('assets/js/apexchart.js')}}" defer></script>


<script type="text/javascript">
    let c = false;

    function slideopen() {

        let element = document.getElementById("iconDisplay");
        let element1 = document.getElementById("iconDisplay1");
        let element2 = document.getElementById("iconDisplay2");
        let element3 = document.getElementById("iconDisplay3");
        let element4 = document.getElementById("iconDisplay4");
        let element5 = document.getElementById("");

        if (c) {
            document.getElementById("logout").style.display = 'block';
            document.getElementById("text-designer").style.display = 'block';
            element.classList.remove("mystyle");
            element1.classList.remove("mystyle");
            element2.classList.remove("mystyle");
            element3.classList.remove("mystyle");
            element4.classList.remove("mystyle");
            element5.classList.remove("mystyle");
            c = false;
        }
        else {
            document.getElementById("logout").style.display = 'none';
            document.getElementById("text-designer").style.display = 'none';
            element.classList.add("mystyle");
            element1.classList.add("mystyle");
            element2.classList.add("mystyle");
            element3.classList.add("mystyle");
            element4.classList.add("mystyle");
            element5.classList.add("mystyle");
            c = true;
        }
    }
</script>

</body>

</html>
