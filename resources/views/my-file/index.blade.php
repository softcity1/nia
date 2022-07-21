@extends('home')
@section('title', 'My Files - NB')
@section('content')
    <div class="content-inner container-fluid pt-3" id="page_layout">

        <div class="row g-3">
            <div class="col-lg-8 col-md-12 ps-lg-0">
                <div>
                    <h4 class="text-capitalize fs-3 mb-3">My FIles</h4>
                </div>
                <div class="card card-block card-stretch border-2 card-height">
                    <div class="card-body">
                        <div class="row row-cols-lg-4 row-cols-md-3 row-cols-2 g-3" id="page_data"></div>
                    </div>
                    <div class="paq-pager m-3"></div>
                </div>
            </div>

            <div class="col-lg-4 col-md-12">
                <div class="text-center mb-3">
                    <h4 class="text-capitalize fs-3 mb-3">Compliance</h4>
                </div>
                <div class="card card-block card-stretch border-2 card-height">

                    <div class="card-body">
                        <div class="row g-3">
                            <div class="col-lg-12">
                                <div class="text-center">
                                    <div>
                                        <h5 class="counter">Validation Insight</h5>
                                        <small></small>
                                    </div>
                                    <div>
                                        <div id="Polar_apexcharts"></div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-12">
                                <div class="text-center">
                                    <div>
                                        <h5 class="counter">Validation Trend</h5>
                                        <small></small>
                                    </div>
                                    <div>
                                        <div id="line_apexcharts"></div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-12">
                                <div class="text-center">
                                    <div>
                                        <h5 class="counter">Total Validation</h5>
                                    </div>
                                    <div>
                                        <div id="grossVolume"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="{{asset('assets/js/jquery.min.js')}}"></script>
    <script src="{{asset('assets/js/sweetalert2.js')}}"></script>
    <script>
        $getData = '{{ url('get/files') }}';
        $token = '{{ csrf_token() }}';
        $page = 1;
        $perPage = 10;
        $(document).ready(function () {
            showData();
        });

        $(document).on("click", '.paq-pager ul.pagination a', function (e) {
            e.preventDefault();
            $page = $(this).attr('href').split('page=')[1];
            showData();
        });

        function showData() {
            $formData = {
                '_token': $token,
                per_page: $perPage,
                page: $page,
            };
            $.ajax({
                url: $getData,
                type: 'GET',
                data: $formData,
                success: function (response) {
                    $('#body-data').html('');
                    let html = '';
                    if (response.data.data) {
                        let imagePath = "{{asset('assets/images/my-file.png')}}";
                        $.each(response.data.data, function (i, v) {
                            let filePath = '{{asset('images/file')}}' + '/' + v.file;
                            html += '<div class="col">\n' +
                                '       <div class="text-center">\n' +
                                '           <a href="' + filePath + '" download>\n' +
                                '               <img src="' + imagePath + '" class="img-fluid w-50">\n' +
                                '           </a>\n' +
                                '           <p class="text-muted font-12 text-capitalize">' + v.original_name + '</p>\n' +
                                '       </div>\n' +
                                '    </div>';
                            $('#page_data').html(html);
                        });
                        if (response.pager !== 'undefined') {
                            $('.paq-pager').html(response.pager);
                        }
                    } else {
                        swal("Error!", response.message, "error");
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
        }
    </script>
@endsection
