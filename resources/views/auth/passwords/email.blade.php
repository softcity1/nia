@extends('layouts.app')

@section('content')
    <div class="col-12 col-sm-12 col-md-12 col-lg-6 col-xl-6 col-xxl-6 login_right_side p-5 ">
        <div class="m-lg-4 m-xl-4 d-flex w-100 align-items-center justify-content-center h-100">
            @if (session('status'))
                <div class="alert alert-success alert-dismissible" role="alert">
                    {{ session('status') }}
                </div>
            @endif
            <div class="card shadow login_right_side_card p-5 m-lg-5 m-xl-5 bg-transparent border-2">
                <div class="card-header  login_right_side_card_header text-center">
                    <img src="{{asset('assets/images/lock.png')}}" class="img-fluid login_right_side_card_img">
                    <h2 class="login_right_side_card_heading mt-3">Password Reset</h2>
                    <p class="login_right_side_card_para">Enter your email and we will send you a reset link</p>
                </div>
                <div class="card-body">
                    <div class="mb-3">
                        <label class="form-label login_lable">Email or phone number</label>
                        <input type="email"
                               class="form-control form-control-lg @error('email') is-invalid @enderror" id="email"
                               name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>
                        @error('email')
                        <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                        @enderror
                    </div>
                    <button type="button" class="btn btn-lg login_btn form-control send_reset_email text-center mt-2">
                        Send me a link
                    </button>
                    <div class="d-flex justify-content-between">
                        <a href="{{url('/')}}" class="text-decoration-none">Return To Login</a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!--Send OTP  Modal -->
    <div class="modal otp_modal fade" id="sendotpModal" tabindex="-1" aria-labelledby="exampleModalLabel"
         aria-hidden="true">
        <div class="modal-dialog otp_modal_dailoge">
            <div class="modal-content otp_modal_content">
                <div class="modal-header otp_modal_header">
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body text-center p-5">
                    <span class="envelope_bg"><i class="bi bi-envelope"></i></span>
                    <h3 class="login_right_side_card_heading mt-3">Reset email sent</h3>
                    <p class="login_right_side_card_para">We have just sent an email with apassword reset link to</p>
                    <span class="fw-bold text-dark"><strong class="user_email"></strong></span>
                    <form>
                        <button type="button" class="btn btn-lg login_btn form-control text-center mt-2"
                                data-bs-dismiss="modal"
                                data-bs-toggle="modal" data-bs-target="#enterotpModal">Enter OTP
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!--Enter OTP  Modal -->
    <div class="modal otp_modal fade" id="enterotpModal" tabindex="-1" aria-labelledby="exampleModalLabel"
         aria-hidden="true">
        <div class="modal-dialog otp_modal_dailoge">
            <div class="modal-content otp_modal_content">
                <div class="modal-header otp_modal_header">
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body text-center py-5">
                    <h1 class="login_right_side_card_heading">Enter OTP</h1>
                        <div class="mt-5">
                            <input class="otp otp_input" id="otp_1" required type="text" oninput='digitValidate(this)' onkeyup='tabChange(1)'
                                   maxlength=1>
                            <input class="otp otp_input" id="otp_2" required type="text" oninput='digitValidate(this)' onkeyup='tabChange(2)'
                                   maxlength=1>
                            <input class="otp otp_input" id="otp_3" required type="text" oninput='digitValidate(this)' onkeyup='tabChange(3)'
                                   maxlength=1>
                            <input class="otp otp_input" id="otp_4" required type="text" oninput='digitValidate(this)' onkeyup='tabChange(4)'
                                   maxlength=1>
                        </div>
                        <div class="">
                            <button class="btn btn-lg enter_otpbtn mt-5">Enter OTP</button>
                            <button type="button" class="btn btn-lg send_againbtn mt-5 resend_email">Send Again</button>
                        </div>
                </div>
            </div>
        </div>
    </div>

    <script src="{{asset('assets/js/jquery.min.js')}}"></script>
    <script src="{{asset('assets/js/sweetalert2.js')}}"></script>
    <script type="text/javascript">
        $token = '{{csrf_token()}}';
        $resetPassword = "{{ route('password.email') }}";
        $checkOtp = "{{ route('verify.otp') }}";
        $(document).ready(function () {

        });

        $('body').on('click', '.send_reset_email', function () {
            sendEmail(0);
        });

        $('body').on('click', '.resend_email', function () {
            sendEmail(1);
        });

        $('body').on('click', '.enter_otpbtn', function () {
            let val1 = $('#otp_1').val();
            let val2 = $('#otp_2').val();
            let val3 = $('#otp_3').val();
            let val4 = $('#otp_4').val();
            let value = val1 + val2 + val3 + val4;
            var email = $('#email').val();
            $('.user_email').html(email);
            $formData = {
                '_token': $token,
                email: email,
                otp: value,
            };
            $.ajax({
                url: $checkOtp,
                type: 'POST',
                data: $formData,
                success: function (response) {
                    hideLoader();
                    if (response.success == true) {
                        window.location.href = '{{ url('reset/password') }}';
                        swal('Success', response.message, 'success');
                    } else {
                        swal('Error', response.message, 'error');
                    }
                },
                error: function (error) {
                    hideLoader();
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

        function sendEmail(isResend) {
            showLoader();
            var email = $('#email').val();
            $('.user_email').html(email);
            $formData = {
                '_token': $token,
                email: email,
            };
            $.ajax({
                url: $resetPassword,
                type: 'POST',
                data: $formData,
                success: function (response) {
                    hideLoader();
                    if (response.success == true) {
                        if (isResend == 0) {
                            $('#sendotpModal').modal('show');
                        }
                        swal('Success', response.message, 'success');
                    } else {
                        swal('Error', response.message, 'error');
                    }
                },
                error: function (error) {
                    hideLoader();
                    $message = 'Something went wrong';
                    swal("Error!", $message, "error");
                }
            })
        }

        let digitValidate = function (ele) {
            ele.value = ele.value.replace(/[^0-9]/g, '');
        };

        let tabChange = function (val) {
            let ele = document.querySelectorAll('input');
            if (ele[val - 1].value != '') {
                ele[val].focus()
            } else if (ele[val - 1].value == '') {
                ele[val - 2].focus()
            }
        }
    </script>
@endsection
