@extends('home')
@section('title', 'Settings - NB')
@section('content')
    <div class="content-inner container-fluid pt-3" id="page_layout">

        <div class="row g-3">
            <div class="col-lg-12">
                <div>
                    @if(isAdmin())
                        <h4 class="text-capitalize fs-3 mb-3">{{ !empty($user) ? 'Edit' : 'Create' }} Company
                            Admin </h4>
                    @else
                        <h4 class="text-capitalize fs-3 mb-3">{{ !empty($user) ? 'Edit' : 'Create' }} Company user </h4>
                    @endif
                </div>
                <div class="card card-block card-stretch border-2 card-height">
                    <div class="card-body">
                        <div class="inner-div-form">
                            <form class="row g-4" id="create-user" enctype="multipart/form-data">
                                @csrf
                                <div class="col-md-12 @if(isAdmin() == false) d-none @endif">
                                    <strong class="text-black text-capitalize">Contact Person</strong>
                                </div>
                                <input type="hidden" name="id" value="{{ @$user->id }}">

                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label class="text-muted text-capitalize">First Name</label>
                                        <input type="text" class="form-control form-control-lg" required
                                               name="first_name"
                                               value="{{ @$user->first_name }}" placeholder="Enter your first name">
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label class="text-muted text-capitalize">Last Name</label>
                                        <input type="text" class="form-control form-control-lg" required
                                               name="last_name"
                                               value="{{ @$user->last_name }}" placeholder="Enter your last name">
                                    </div>
                                </div>
                                @if(isAdmin() == true)
                                    @php
                                        $display = 'block';
                                    @endphp
                                    @if(!empty($user) && $user->user_type == 1)
                                        @php
                                        $display = 'none';
                                        @endphp
                                        @endif
                                        <div class="col-md-6" style="display: {{ $display }};">
                                            <div class="mb-3">
                                                <label class="text-muted text-capitalize">Company Name</label>
                                                <input type="text" class="form-control form-control-lg"
                                                       name="company_name"
                                                       value="{{ @$user->company_name }}"
                                                       placeholder="Enter your company name">
                                            </div>
                                        </div>

                                        <div class="col-md-6" style="display: {{ $display }};">
                                            <div class="mb-3">
                                                <label class="text-muted text-capitalize">Company Logo</label>
                                                <input type="file" class="form-control form-control-lg"
                                                       id="upload-image"
                                                       name="file"
                                                       value="{{ @$user->company_logo }}" placeholder="Company Logo">
                                            </div>
                                        </div>

                                        <div class="col-md-6" style="display: {{ $display }};">
                                            <div class="mb-3">
                                                <label class="text-muted text-capitalize">Company Address</label>
                                                <input type="text" class="form-control form-control-lg" name="address"
                                                       value="{{ @$user->address }}"
                                                       placeholder="Enter your company address">
                                            </div>
                                        </div>
                                    @endif
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label class="text-muted text-capitalize">Email</label>
                                        <input type="text" class="form-control form-control-lg" required name="email"
                                               value="{{ @$user->email }}" placeholder="Enter your email">
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label class="text-muted text-capitalize">Phone Number</label>
                                        <input type="number" class="form-control form-control-lg" required name="phone"
                                               value="{{ @$user->phone }}" placeholder="Enter your phone number">
                                    </div>
                                </div>

                                <div class="col-lg-12">
                                    <div class="text-center mt-3">
                                        <button type="submit"
                                                class="text-decoration-none w-25 text-white text-capitalize border-radius-15 btn p-3 bg-green-btn">
                                            {{ !empty($user) ? 'Update' : 'Create' }} User
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
        $(document).ready(function () {

        });

        $('#create-user').submit(function (e) {
            e.preventDefault();
            var formData = new FormData(this);
            $.ajax({
                url: '{{ url('user/store') }}',
                type: 'POST',
                data: formData,
                contentType: false,
                processData: false,
                success: function (response) {
                    if (response.success == true) {
                        swal('Success', response.message, 'success');
                        setTimeout(function () {
                            window.location.href = '{{ url('/user') }}';
                        }, 2000);
                    } else {
                        swal('error', response.message, 'error')
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
    </script>
@endsection
