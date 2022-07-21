@extends('layouts.app')

@section('content')
    <div class="col-12 col-sm-12 col-md-12 col-lg-6 col-xl-6 col-xxl-6 login_right_side p-5 ">
        @if (session('status'))
            <div class="alert alert-success alert-dismissible" role="alert">
                {{ session('status') }}
            </div>
        @endif
        <div class="card shadow login_right_side_card p-5 m-lg-5 m-xl-5 bg-transparent border-2">
            <div class="card-header  login_right_side_card_header text-center">
                <img src="{{asset('assets/images/lock.png')}}" class="img-fluid login_right_side_card_img">
                <h2 class="login_right_side_card_heading mt-3">Reset Password</h2>
            </div>
            <div class="card-body">
                <form id="reset_password_form" enctype="multipart/form-data">
                    @csrf
                    <div class="mb-3">
                        <label class="form-label login_lable">Email or phone number</label>
                        <input type="email" class="form-control form-control-lg" id="email"
                               name="email" value="{{ old('email') }}" placeholder="Enter your registered email"
                               required autocomplete="email" autofocus>
                    </div>
                    <div class="mb-3">
                        <label class="form-label login_lable">New Password</label>
                        <input type="password" class="form-control form-control-lg" id="password"
                               name="password" placeholder="Enter your password" required autofocus>
                    </div>
                    <div class="mb-3">
                        <label class="form-label login_lable">Confirm Password</label>
                        <input type="password" class="form-control form-control-lg" id="password-confirm"
                               name="password_confirmation" placeholder="Enter your password" required autofocus>
                    </div>
                    <button class="btn btn-lg login_btn form-control text-center mt-2">
                        Reset Password
                    </button>
                </form>
                <div class="d-flex justify-content-between">
                    <a href="{{url('/')}}" class="text-decoration-none">Return To Login</a>
                </div>
            </div>
        </div>
    </div>

    <script src="{{asset('assets/js/jquery.min.js')}}"></script>
    <script src="{{asset('assets/js/sweetalert2.js')}}"></script>
    <script type="text/javascript">
        $token = '{{csrf_token()}}';
        $resetPassword = "{{ route('reset.user.password') }}";
        $(document).ready(function () {

        });

        $('#reset_password_form').submit(function (e) {
            e.preventDefault();
            var formData = new FormData(this);
            $.ajax({
                url:$resetPassword,
                type:'POST',
                data:formData,
                contentType:false,
                processData:false,
                success:function (response) {
                    if (response.success == true) {
                        window.location.href = '{{ url('/') }}';
                        swal('Success', response.message, 'success');
                    } else {
                        swal('Error', response.message, 'error');
                    }
                },
                error: function (error) {
                    $message = 'Something went wrong';
                    swal("Error!", $message, "error");
                }
            })
        });

        function showLoader() {
            $('#preloader').show();
            $(document.body).css('pointer-events', 'none');
        }

        function hideLoader() {
            $('#preloader').hide();
            $(document.body).css('pointer-events', 'all');
        }
    </script>
@endsection
