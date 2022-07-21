@extends('layouts.app')

@section('content')
    <div class="col-12 col-sm-12 col-md-12 col-lg-6 col-xl-6 col-xxl-6 login_right_side  p-5">
        <div class="m-lg-2 m-xl-2 d-flex w-100 align-items-center justify-content-center h-100">
            <div class="card shadow bg-transparent w-75 m-lg-5 m-xl-5 login_right_side_card shadow border-2 p-5">
                <div class="card-header  login_right_side_card_header text-center">
                    <img src="{{asset('assets/images/hi.png')}}" class="img-fluid login_right_side_card_img">
                    <h2 class="login_right_side_card_heading mt-3">Grant Permission</h2>
                </div>
                <div class="card-body">
                    <form class="form g-3" id="grant_access">
                        @csrf
                        <input type="hidden" name="requested_id" value="{{ @$requestedId }}">
                        <input type="hidden" name="granter_id" value="{{ @$granterId }}">
                        <div class="col-lg-12">
                            <div class="row">
                                <div class="col-sm-6">
                                    <input type="radio" hidden name="is_accept" value="1" class="grant_radio" id="radio_accept">
                                    <button type="submit"
                                            class="btn btn-lg btn-success grant_button form-control text-center mt-2"
                                            id="accept">Accept
                                    </button>
                                </div>
                                <div class="col-sm-6">
                                    <input type="radio" hidden name="is_accept" value="0" class="grant_radio" id="radio_reject">
                                    <button type="submit"
                                            class="btn btn-lg btn-danger grant_button form-control text-center mt-2"
                                            id="reject">Reject
                                    </button>
                                </div>
                            </div>
                        </div>
                    </form>
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

        $('body').on('click', '.grant_button', function () {
           let id = $(this).attr('id');
           $('#radio_' + id).prop('checked', true);
        });

        $('#grant_access').submit(function (e) {
            e.preventDefault();
            showLoader();
            let formData = new FormData(this);
            $.ajax({
                url: '{{ url('grant/user/access') }}',
                type: 'POST',
                data: formData,
                contentType: false,
                processData: false,
                success: function (response) {
                    hideLoader();
                    if (response.success == true) {
                        swal('Success', response.message, 'success')
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
