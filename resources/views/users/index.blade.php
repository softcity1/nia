@extends('home')
@section('title', 'Settings - NB')
@section('content')
    <div class="content-inner container-fluid pt-3" id="page_layout">

        <div class="row g-3">
            <div class="col-lg-12 col-md-12 ps-lg-0">
                <div class="row">
                    <div class="col-sm-6">
                        <h4 class="text-capitalize fs-3 mb-3">Users</h4>
                    </div>
                    <div class="col-sm-6">
                        <a href="{{url('/user/create')}}" class="btn btn-success float-right">Add New</a>
                    </div>
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
                                    <span class="text-capitalize">Date And Time</span>
                                </th>
                                @if(isCompany())
                                    <th class="text-center">
                                        <span class="text-capitalize">Name</span>
                                    </th>
                                @else
                                    <th class="text-center">
                                        <span class="text-capitalize">Company Name</span>
                                    </th>
                                    <th class="text-center">
                                        <span class="text-capitalize">Contact Person</span>
                                    </th>
                                @endif
                                <th class="text-center">
                                    <span class="text-capitalize">Email</span>
                                </th>
                                <th class="text-center">
                                    <span class="text-capitalize">Phone</span>
                                </th>
                                <th class="text-end">
                                    <span class="text-capitalize">Action</span>
                                </th>
                                </thead>
                                <tbody id="page-data"></tbody>
                            </table>
                        </div>
                        <div class="paq-pager m-3"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="{{asset('assets/js/jquery.min.js')}}"></script>
    <script src="{{asset('assets/js/sweetalert2.js')}}"></script>
    <script>
        $token = '{{ csrf_token() }}';
        $user = '{{ url('user') }}';
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
                url: $user + '/show',
                type: 'GET',
                data: $formData,
                success: function (response) {
                    $('#body-data').html('');
                    let html = '';
                    let isCompany = "{{ isCompany() }}";
                    if (response.data.data.length > 0) {
                        let display = 'block';
                        if (isCompany !== '') {
                            display = 'none';
                        }
                        $.each(response.data.data, function (i, v) {
                            html += '<tr class="text-center" id="user_' + v.id + '"><td>' + v.id + '</td>' +
                                '<td>' + v.created_at + '</td>' +
                                '<td>' + v.name + '</td>' +
                                '<td style="display: ' + display + '">' + v.company_name + '</td>' +
                                '<td>' + v.email + '</td>' +
                                '<td>' + v.phone + '</td>' +
                                '<td class="text-end">\n' +
                                '<a href="' + $user + '/' + v.id + '/edit' + '" class="edit-button-group text-primary">Edit</a>\n' +
                                '<a href="javascript:void(0)" id="delete_' + v.id + '" class="delete text-danger">Delete</a>\n' +
                                '</td>' +
                                '</tr>';
                            $('#page-data').html(html);
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

        $('body').on('click', '.delete', function () {
            var result = confirm('Are you sure to delete?');
            if (result) {
                var id = $(this).attr('id');
                id = id.split('_')[1];
                $.ajax({
                    url: '{{ url('delete') }}' + '/' + id,
                    type: 'POST',
                    data: {'_token': $token},
                    success: function (response) {
                        if (response.success == true) {
                            showData();
                            $('#user_' + id).remove();
                            swal('Success', response.message, 'success');
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
        });

    </script>
@endsection
