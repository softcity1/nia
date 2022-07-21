@extends('layouts.app')

@section('content')
    <div class="col-12 col-sm-12 col-md-12 col-lg-6 col-xl-6 col-xxl-6 login_right_side  p-5">
        <div class="m-lg-2 m-xl-2 d-flex w-100 align-items-center justify-content-center h-100">
            <div class="card shadow bg-transparent w-75 m-lg-5 m-xl-5 login_right_side_card shadow border-2 p-5">
                <div class="card-header  login_right_side_card_header text-center">
                    <img src="{{asset('assets/images/hi.png')}}" class="img-fluid login_right_side_card_img">
                    <h2 class="login_right_side_card_heading mt-3">Welcome back!</h2>
                    <p class="login_right_side_card_para">Lets build a great community of insurers</p>
                </div>
                <div class="card-body">
                    <form class="form g-3" method="POST" action="{{ route('login') }}">
                        @csrf
                        <div class="col-lg-12">
                            <div class="mb-3">
                                <label class="form-label login_lable">E-mail or phone number</label>
                                <input type="email" id="email"
                                       class="form-control form-control-lg @error('email') is-invalid @enderror"
                                       name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>
                                @error('email')
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-lg-12">
                            <div class="mb-3">
                                <label class="form-label login_lable">Password</label>
                                <input type="password"
                                       class="form-control form-control-lg @error('password') is-invalid @enderror"
                                       id="password" name="password" required autocomplete="current-password">
                            </div>
                            @error('password')
                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                            @enderror
                        </div>
                        <div class="col-lg-12">
                            <div class="d-flex justify-content-between">
                                <div class="mb-3 form-check">
                                    <input type="checkbox" class="form-check-input" id="exampleCheck1">
                                    <label class="form-check-label" for="exampleCheck1">Remember Me</label>
                                </div>
                                @if (Route::has('password.request'))
                                    <a href="{{ route('password.request') }}" class="text-decoration-none">Forget
                                        password?</a>
                                @endif
                            </div>
                        </div>
                        <div class="col-lg-12">
                            <button type="submit" class="btn btn-lg login_btn form-control text-center mt-2 ">Sign in</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
