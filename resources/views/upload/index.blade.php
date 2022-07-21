@extends('home')
@section('title', 'Upload - NB')
@section('content')
    <div class="content-inner container-fluid pt-3" id="page_layout">
        <div class="row g-3">

            <div class="card card-block card-stretch border-2">
                <div class="card-body">
                    <div class="table-responsive" style="height: 101vh;">
                        <table id="transaction-table-1" class="table mb-0 table-striped" role="grid">
                            <thead class="border-radius-12 bg-head-table">
                            <th>
                                <span class="text-capitalize">file name</span>
                            </th>
                            <th></th>
                            <th></th>
                            <th>
                                <span class="text-capitalize">data modified</span>
                            </th>
                            <th>
                                <span class="text-capitalize">size</span>
                            </th>
                            <th class="text-center">
                                <span class="text-capitalize">contribution</span>
                            </th>
                            <th></th>
                            <th></th>
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
            <div class="card card-block card-stretch border-2" style="height:134vh">
                <div class="card-body">
                    <div class="row g-3">
                        <div class="col-lg-12">
                            <div class="text-center">
                                <div>
                                    <h5 class="counter">Validation Insight</h5>
                                    <small>Customers that buy our products</small>
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
                        let imagePath = '{{asset('assets/images/xls.png')}}';
                        let actionImage = '{{asset('assets/images/download.jpg')}}';
                        $.each(response.data.data, function (i, v) {
                            let filePath = '{{asset('images/file')}}' + '/' + v.file;
                            html += '<tr>\n' +
                                '      <td colspan="3">\n' +
                                '          <div class="d-flex align-items-center">\n' +
                                '              <div>\n' +
                                '                  <img src="' + imagePath + '" class="h-60px w-60px">\n' +
                                '              </div>\n' +
                                '                 <div class="ms-3">' + v.original_name + '</div>\n' +
                                '          </div>\n' +
                                '      </td>\n' +
                                '         <td class="text-primary">' + v.created_at + '</td>\n' +
                                '      <td class="text-dark">\n' +
                                '          <p class="border rounded-pill p-3 text-primary">'+v.file_size+'</p>\n' +
                                '      </td>\n' +
                                '      <td colspan="3">\n' +
                                '          <div>\n' +
                                '              <div class="d-flex align-items justify-content-between">\n' +
                                '                  <div>\n' +
                                '                      <p class="mb-0 text-capitalize font-12">0 Minutes Remaining</p>\n' +
                                '                  </div>\n' +
                                '                  <div>\n' +
                                '                      <p class="mb-0 text-capitalize text-muted font-12">100% </p>\n' +
                                '                  </div>\n' +
                                '              </div>\n' +
                                '              <div class="progress border-radius-12" style="height: 10px;">\n' +
                                '                  <div class="progress-bar w-100 border-radius-12 bg-green" role="progressbar" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100"></div>\n' +
                                '              </div>\n' +
                                '          </div>\n' +
                                '      </td>\n' +
                                '      <td class="text-end">\n' +
                                '               <a href="' + filePath + '" download>\n' +
                                '                   <img src="' + actionImage + '" class="w-60px h-100">\n' +
                                '               </a> ' +
                                '      </td>\n' +
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
    </script>
@endsection
