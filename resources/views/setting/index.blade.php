@extends('home')
@section('title', 'Settings - NB')
@section('content')
    <div class="content-inner container-fluid pt-3" id="page_layout">

        <div class="row g-3">
            <div class="col-lg-12">
                <div class="row">
                    <div class="col-sm-6">
                        <h4 class="text-capitalize fs-3 mb-3">Manage Your Profile</h4>
                    </div>
                    <div class="col-sm-6">
                        <button class="btn btn-success float-right @if(!isCompanyUser()) d-none @endif"
                                onclick="requestPermission()">Request Permission
                        </button>
                    </div>
                </div>
                <div class="card card-block card-stretch border-2 card-height">
                    <div class="card-body">
                        <div class="inner-div-form">
                            <form class="row g-4" id="update_profile" enctype="multipart/form-data">
                                @csrf
                                <div class="col-lg-12">
                                    <div class="text-center mb-4">
                                        @if(!empty(loginUserImage()))
                                            <label for="upload-image">
                                                <img src="{{loginUserImage()}}"
                                                     class="img-fluid img-upload-div">
                                            </label>
                                        @else
                                            <label for="upload-image" class="img-upload-div">
                                                <img src="{{asset('assets/images/camera.png')}}" class="img-fluid">
                                            </label>
                                        @endif
                                        <h5 class="text-capitalize text-primary mt-2">
                                            upload photo
                                        </h5>
                                        <input type="file" class="d-none" id="upload-image" name="file"
                                               value="{{loginUserImage()}}">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label class="text-muted text-capitalize">First Name</label>
                                        <input type="text" class="form-control form-control-lg" name="first_name"
                                               value="{{ loginFirstName() }}" placeholder="Enter your first name">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label class="text-muted text-capitalize">Last Name</label>
                                        <input type="text" class="form-control form-control-lg" name="last_name"
                                               value="{{ loginLastName() }}" placeholder="Enter your last name">
                                    </div>
                                </div>

                                <div class="col-md-6 @if(isCompanyUser() && isUserPermit() == false) d-none @endif">
                                    <div class="mb-3">
                                        <label class="text-muted text-capitalize">Your email</label>
                                        <input type="text" class="form-control form-control-lg" name="email"
                                               value="{{ loginUserEmail() }}" placeholder="Enter your email">
                                    </div>
                                </div>

                                <div class="col-md-6 @if(isCompanyUser() && isUserPermit() == false) d-none @endif">
                                    <div class="mb-3">
                                        <label class="text-muted text-capitalize">Phone Number</label>
                                        <input type="number" class="form-control form-control-lg" name="phone"
                                               value="{{ loginUserPhone() }}" placeholder="Enter your phone number">
                                    </div>
                                </div>

                                <div class="col-md-6 @if(isCompanyUser() && isUserPermit() == false) d-none @endif">
                                    <div class="mb-3">
                                        <label class="text-muted text-capitalize">Date of Birth</label>
                                        <input type="date" class="form-control form-control-lg" name="date_of_birth"
                                               value="{{ loginUserDOB() }}" placeholder="Enter your birthdate">
                                    </div>
                                </div>

                                <div class="col-md-6 @if(isCompanyUser() && isUserPermit() == false) d-none @endif">
                                    <div class="mb-3">
                                        <label class="text-muted text-capitalize">Gender</label>
                                        <select class="form-select form-select-lg" name="gender">
                                            <option value="1" @if(loginUserGender() == 1) selected @endif>Male
                                            </option>
                                            <option value="2" @if(loginUserGender() == 2) selected @endif>Female
                                            </option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label class="text-muted text-capitalize">password</label>
                                        <input type="password" class="form-control form-control-lg" name="password"
                                               value="" placeholder="Enter secure password">
                                    </div>
                                </div>

                                <div class="col-lg-12">
                                    <div class="text-center mt-3">
                                        <button type="submit"
                                                class="text-decoration-none w-25 text-white text-capitalize border-radius-15 btn p-3 bg-green-btn">
                                            Update
                                        </button>
                                    </div>
                                </div>

                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="{{asset('assets/js/jquery.min.js')}}"></script>
    <script src="{{asset('assets/js/sweetalert2.js')}}"></script>
    <script>
        $token = '{{ csrf_token() }}';
        $getPermission = '{{ url('access/permission') }}';
        $(document).ready(function () {

        });

        $('#update_profile').submit(function (e) {
            e.preventDefault();
            var formData = new FormData(this);
            $.ajax({
                url: '{{ url('update/profile') }}',
                type: 'POST',
                data: formData,
                contentType: false,
                processData: false,
                success: function (response) {
                    if (response.success == true) {
                        swal('Success', response.message, 'success')
                    }
                },
                error: function (error) {
                    $message = '';
                    $message = '';
                    $.each(error.responseJSON.errors, function (i, v) {
                        $message += v + "\n";
                    });
                    swal("Error!", $message, "error");
                }
            })
        });

        function requestPermission() {
            showLoader();
            $formData = {
                '_token': $token,
            };
            $.ajax({
                url: $getPermission,
                type: 'POST',
                data: $formData,
                success: function (response) {
                    hideLoader();
                    if (response.success == true) {
                        swal('Success', response.message, 'success');
                    } else {
                        swal('Success', response.message, 'success');
                    }
                },
                error: function (error) {
                    hideLoader();
                    $message = '';
                    $message = '';
                    $.each(error.responseJSON.errors, function (i, v) {
                        $message += v + "\n";
                    });
                    swal("Error!", $message, "error");
                }
            })
        }

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
