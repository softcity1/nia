@extends('home')
@section('title', 'Audit Trail - NB')
@section('content')
    <div class="content-inner container-fluid pt-3" id="page_layout">

        <div class="row g-3">
            <div class="col-lg-8 col-md-12 ps-lg-0">
                <div>
                    <h4 class="text-capitalize fs-3 mb-3">Audit Trails</h4>
                </div>
                <div class="card card-block card-stretch border-2 card-height">
                    <div class="card-body">
                        <div class="table-responsive" style="height: 101vh;">
                            <table id="transaction-table-1" class="table mb-0 table-striped" role="grid">
                                <thead class="border-radius-12 bg-head-table">
                                <th class="text-center">
                                    <span class="text-capitalize">S No.</span>
                                </th>
                                <th class="text-center">
                                    <span class="text-capitalize">Activity</span>
                                </th>
                                <th>
                                    <span class="text-capitalize">Date and Time</span>
                                </th>
                                <th class="text-end">
                                    <span class="text-capitalize">Action</span>
                                </th>
                                </thead>
                                <tbody id="page_data">
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="paq-pager m-3"></div>
                </div>
            </div>

            <div class="col-lg-4 col-md-12">
                <div class="text-center mb-3">
                    <h4 class="text-capitalize fs-3 mb-3">Compliance history</h4>
                </div>
                <div class="card card-block card-stretch border-2 card-height">

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
    </div>
    <script src="{{asset('assets/js/jquery.min.js')}}"></script>
    <script src="{{asset('assets/js/sweetalert2.js')}}"></script>
    <script>
        $getData = '{{ url('get/audit-trail') }}';
        $token = '{{ csrf_token() }}';
        $page = 1;
        $perPage = 15;
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
                        $.each(response.data.data, function (i, v) {
                            let colorClass = 'bg-light-green text-green';
                            if (v.status == 'Unsuccessful') {
                                colorClass = 'bg-light-pink text-orange'
                            }
                            html += '<tr>\n' +
                                '    <td class="text-center">\n' +
                                '        <p class="mb-0 text-dark">' + v.id + '</p>\n' +
                                '    </td>\n' +
                                '    <td class="text-center">\n' +
                                '        <p class="mb-0 text-dark text-capitalize">' + v.title + '</p>\n' +
                                '    </td>\n' +
                                '    <td>\n' +
                                '        <p class="mb-0 text-muted">' + v.created_at + '</p>\n' +
                                '    </td>\n' +
                                '    <td class="text-end">\n' +
                                '        <p class="mb-0 text-center ps-4 pe-4 p-2 ' + colorClass + ' rounded-pill text-capitalize">' + v.status + '</p>\n' +
                                '    </td>\n' +
                                ' </tr>';
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

