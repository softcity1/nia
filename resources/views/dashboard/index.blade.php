@extends('home')
@section('title', 'Home - NB')
@section('content')
    <div class="content-inner container-fluid pt-3" id="page_layout">

        <div class="row g-3">
            <div class="col-lg-8 col-md-12 ps-lg-0">
                <div class="card card-block card-stretch border-2">
                    <div class="card-body">
                        <form id="upload_excel" enctype="multipart/form-data">
                            @csrf
                            <div class="row">
                                <div class="col-lg-6 col-md-12">
                                    <div>
                                        <h4 class="text-capitalize text-center">Upload Reports</h4>
                                        <p>
                                            Dear Insurer, you are welcomed to the NIA data report portal. In an effort
                                            to
                                            standardize our data collection, we will implore you to upload your reports
                                            from
                                            this portal.
                                        </p>
                                    </div>
                                </div>
                                <div class="col-lg-6 col-md-12">
                                    <div class="upload-div-file">
                                        <label class="text-center" for="dropfile">
                                            <div class="mb-3">
                                                <img src="{{asset('assets/images/vector-blue.png')}}"
                                                     class="img-fluid w-25s">
                                            </div>
                                            <p>
                                                Drop files here or <span
                                                    class="text-capitalize text-primary">browser</span>
                                            </p>
                                        </label>
                                        <input type="file" class="form-control d-none"
                                               accept="application/vnd.openxmlformats-officedocument.spreadsheetml.sheet"
                                               id="dropfile" onchange="checkfile(this)" name="file">
                                    </div>
                                    <div class="d-flex align-items-center mt-3">
                                        <div class="w-50">
                                            <a href="#"
                                               class="text-decoration-none btn text-capitalize border border-primary text-primary p-3 w-100">
                                                cancel
                                            </a>
                                        </div>
                                        <div class="w-50 ms-3">
                                            <button
                                                class="btn p-3 w-100 position-relative bg-green-btn text-white text-capitalize">
                                                upload
                                                <div class="arrow-div">
                                                    <img src="{{asset('assets/images/white-arrow.png')}}"
                                                         class="img-fluid w-20s">
                                                </div>
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="card card-block card-stretch border-2">
                    <div class="card-body">
                        <div class="table-responsive" style="height: 101vh;">
                            <table class="table mb-0 table-striped">
                                <thead>
                                <th>
                                    <span class="text-capitalize">file name</span>
                                </th>
                                <th>
                                    <span class="text-capitalize">date and time</span>
                                </th>
                                <th>
                                    <span class="text-capitalize">size</span>
                                </th>
                                <th>
                                    <span class="text-capitalize">action</span>
                                </th>
                                </thead>
                                <tbody id="page_data"></tbody>
                            </table>
                        </div>
                        <div class="paq-pager m-3"></div>
                    </div>
                </div>
            </div>

            <div class="col-lg-4 col-md-12">
                <div class="text-center">
                    <h4 class="text-capitalize fs-3 mb-3">Compliance History</h4>
                </div>
                <div class="card card-block card-stretch border-2" style="height:150vh">

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
                                        <small>Customers that buy our products</small>
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

    <div class="modal fade" id="progressModal" tabindex="-1" aria-labelledby="exampleModalLabel"
         aria-hidden="true">
        <div class="modal-dialog otp_modal_dailoge">
            <div class="modal-content otp_modal_content">
                <div class="modal-body text-center py-5">
                    <div class="d-flex align-items justify-content-between">
                        <div>
                            <p class="mb-0 text-capitalize font-12" id="progress_comment"></p>
                        </div>
                        <div>
                            <p class="mb-0 text-capitalize text-muted font-12" id="percentage_count"></p>
                        </div>
                    </div>
                    <div class="progress border-radius-12" style="height: 25px;">
                        <div class="progress-bar border-radius-12" id="progressbar" role="progressbar"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="{{asset('assets/js/jquery.min.js')}}"></script>
    <script src="{{asset('assets/js/sweetalert2.js')}}"></script>
    <script>
        $importExcel = '{{ url('import/excel') }}';
        $getData = '{{ url('get/files') }}';
        $token = '{{ csrf_token() }}';
        $page = 1;
        $perPage = 10;
        $isProgressComplete = 0;
        $(document).ready(function () {
            showData();
            $('[data-toggle="tooltip"]').tooltip();
        });

        $('#upload_excel').submit(function (e) {
            e.preventDefault();
            $('#progressModal').modal('show');
            progressUpload();
            let formData = new FormData(this);
            $.ajax({
                url: $importExcel,
                type: 'POST',
                data: formData,
                contentType: false,
                processData: false,
                success: function (response) {
                    if (response.success == true) {
                        $isProgressComplete = 1;
                    } else {
                        swal('Error', response.message, 'error');
                    }
                },
                error: function (error) {
                    swal('Error', 'Something went wrong', 'error');
                },
            })
        });

        function progressUpload() {
            let value = 10;
            $('#percentage_count').html('10%');
            $('#progress_comment').html('Preparing your upload');
            $('#progressbar').css({'width': '10%', 'background': '#fffa61'});
            let interval = window.setInterval(function () {
                value += 10;
                if (value == 30) {
                    $('#percentage_count').html('30%');
                    $('#progress_comment').html('Upload In Progress');
                    $('#progressbar').css({'width': '30%', 'background': '#ddd72f'});
                }
                if (value == 50) {
                    $('#percentage_count').html('50%');
                    $('#progress_comment').html('Initiating Validation');
                    $('#progressbar').css({'width': '50%', 'background': '#cadd2ffa'});
                }
                if (value == 60) {
                    $('#percentage_count').html('60%');
                    $('#progress_comment').html('Validation In Progress');
                    $('#progressbar').css({'width': '60%', 'background': '#b4ef25fa'});
                }
                if (value == 80) {
                    $('#percentage_count').html('80%');
                    $('#progress_comment').html('Validation Completed');
                    $('#progressbar').css({'width': '80%', 'background': '#a8e72efa'});
                }
                if (value == 90) {
                    $('#percentage_count').html('90%');
                    $('#progress_comment').html('Submitting Your File');
                    $('#progressbar').css({'width': '90%', 'background': '#a1e730fa'});
                }
                if (value == 95) {
                    $('#percentage_count').html('95%');
                    $('#progress_comment').html('Generating Result');
                    $('#progressbar').css({'width': '95%', 'background': '#82f950fa'});
                }
                if (value == 100) {
                    $('#percentage_count').html('100%');
                    $('#progress_comment').html('Completed');
                    $('#progressbar').css({'width': '100%', 'background': '#49db0cfa'});
                    if ($isProgressComplete == 1) {
                        showData();
                        $('#progressModal').modal('hide');
                        swal('Success', 'File Uploaded Successfully', 'success');
                        clearInterval(interval);
                    }
                    value = 10;
                }
            }, 1000);
        }

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
                        let imagePath = '{{asset('assets/images/xls.png')}}';
                        let actionImage = '{{asset('assets/images/action-icon.png')}}';
                        $.each(response.data.data, function (i, v) {
                            let filePath = '{{asset('images/file')}}' + '/' + v.file;
                            html += '<tr>\n' +
                                '         <td>\n' +
                                '             <div class="d-flex align-items-center w40">\n' +
                                '                 <div>\n' +
                                '                     <img src="' + imagePath + '" class="w-60px h-60px">\n' +
                                '                 </div>\n' +
                                '                 <div class="ms-3 small_text" data-toggle="tooltip" data-placement="top" title="'+v.original_name+'">' + add3Dots(v.original_name, 30) + '</div>\n' +
                                '             </div>\n' +
                                '         </td>\n' +
                                '         <td class="text-primary">' + v.created_at + '</td>\n' +
                                '         <td class="text-dark">\n' +
                                '             <p class="border rounded-pill p-3 text-primary">' + v.file_size + '</p>\n' +
                                '         </td>\n' +
                                '         <td class="text-end">\n' +
                                '               <a href="' + filePath + '" download>\n' +
                                '                   <img src="' + actionImage + '" class="img-fluid w-20s">\n' +
                                '               </a> ' +
                                '          </td>\n' +
                                '  </tr>';
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

        function add3Dots(string, limit)
        {
            var dots = "...";
            if(string.length > limit)
            {
                // you can also use substr instead of substring
                string = string.substring(0,limit) + dots;
            }

            return string;
        }

        /**
         * This is used to check file extension
         *
         * @param sender
         * @returns {boolean}
         */
        function checkfile(sender) {
            var validExts = new Array(".xlsx", ".xls");
            var fileExt = sender.value;
            fileExt = fileExt.substring(fileExt.lastIndexOf('.'));
            if (validExts.indexOf(fileExt) < 0) {
                swal("Error!", "Please select Excel file only" +
                    validExts.toString() + " types.", "error");
                return false;
            }
            else {
                $('#import-project').removeAttr('disabled');
                return true;
            }
        }
    </script>
@endsection
