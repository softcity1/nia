@extends('home')
@section('title', 'Report - NB')
@section('content')
    <div class="content-inner container-fluid pt-3" id="page_layout">

        <div class="row g-3">
            <div class="col-lg-9 col-md-12 ps-lg-0">
                <div class="mb-3">
                    <h4 class="text-capitalize fs-3 mb-3">dashboard</h4>
                </div>
                <div class="row g-3">
                    <div class="col-lg-6 col-md-12">
                        <div class="card card-block card-stretch card-height border-2 border-radius-12">
                            <div class="card-body">
                                <div>
                                    <div class="d-flex pb-lg-5 pb-xl-5 justify-content-between flex-nowrap">
                                        <div>
                                            <h5 class="text-capitalize mb-0">validation</h5>
                                            <small class="text-muted"></small>
                                        </div>
                                        <div class="pb-lg-5 pb-xl-5">
                                            <div class="d-flex align-items-center">
                                                <div>
                                                    <img src="{{asset('assets/images/circle-blue.png')}}" class="img-fluid w-10">
                                                </div>
                                                <div class="ms-3">
                                                    <p class="mb-0 text-capitalize"></p>
                                                </div>
                                            </div>
                                            <div class="d-flex align-items-center">
                                                <div>
                                                    <img src="{{asset('assets/images/circle-orange.png')}}" class="img-fluid w-10">
                                                </div>
                                                <div class="ms-3">
                                                    <p class="mb-0 text-capitalize"></p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="pt-lg-5 pt-xl-5">
                                        <div id="Polar_apexcharts"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-12">
                        <div class="card card-block card-stretch card-height border-2 border-radius-12">
                            <div class="d-flex card-header border-bottom align-items-center justify-content-between flex-nowrap">
                                <div>
                                    <h5 class="text-capitalize">Uploads Insight</h5>
                                </div>
                                <div>
                                    <div class="d-flex align-items-center mb-3">
                                        <div>
                                            <p class="mb-0 text-muted text-capitalize">show :</p>
                                        </div>
                                        <div>
                                            <select class="form-select bg-transparent border-0 rounded-0 text-primary">
                                                <option selected>By Month</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="card-body">
                                <div>

                                    <div>
                                        <div id="Mixed_apexcharts"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card card-block card-stretch border-2">
                    <div class="card-body">
                        <div class="table-responsive" style="height: 74vh;">
                            <table id="transaction-table-1" class="table text-center mb-0 table-striped" role="grid">
                                <thead>
                                <th>

                                </th>
                                <th>
                                    <span class="text-capitalize fw-bold">total errors</span>
                                </th>
                                <th>
                                    <span class="text-capitalize fw-bold">a</span>
                                </th>
                                <th>
                                    <span class="text-capitalize fw-bold">b</span>
                                </th>
                                <th>
                                    <span class="text-capitalize fw-bold">c</span>
                                </th>
                                <th>
                                    <span class="text-capitalize fw-bold">d</span>
                                </th>
                                <th>
                                    <span class="text-capitalize fw-bold">e</span>
                                </th>
                                </thead>
                                <tbody>
                                <tr>
                                    <td>
                                        <span>A4636</span>
                                    </td>
                                    <td>
                                        <span>131</span>
                                    </td>
                                    <td>
                                        <span>37</span>
                                    </td>
                                    <td>
                                        <span>21</span>
                                    </td>
                                    <td>
                                        <span>29</span>
                                    </td>
                                    <td>
                                        <span>23</span>
                                    </td>
                                    <td>
                                        <span>13</span>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <span>A4636</span>
                                    </td>
                                    <td>
                                        <span>131</span>
                                    </td>
                                    <td>
                                        <span>37</span>
                                    </td>
                                    <td>
                                        <span>21</span>
                                    </td>
                                    <td>
                                        <span>29</span>
                                    </td>
                                    <td>
                                        <span>23</span>
                                    </td>
                                    <td>
                                        <span>13</span>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <span>A4636</span>
                                    </td>
                                    <td>
                                        <span>131</span>
                                    </td>
                                    <td>
                                        <span>37</span>
                                    </td>
                                    <td>
                                        <span>21</span>
                                    </td>
                                    <td>
                                        <span>29</span>
                                    </td>
                                    <td>
                                        <span>23</span>
                                    </td>
                                    <td>
                                        <span>13</span>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <span>A4636</span>
                                    </td>
                                    <td>
                                        <span>131</span>
                                    </td>
                                    <td>
                                        <span>37</span>
                                    </td>
                                    <td>
                                        <span>21</span>
                                    </td>
                                    <td>
                                        <span>29</span>
                                    </td>
                                    <td>
                                        <span>23</span>
                                    </td>
                                    <td>
                                        <span>13</span>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <span>A4636</span>
                                    </td>
                                    <td>
                                        <span>131</span>
                                    </td>
                                    <td>
                                        <span>37</span>
                                    </td>
                                    <td>
                                        <span>21</span>
                                    </td>
                                    <td>
                                        <span>29</span>
                                    </td>
                                    <td>
                                        <span>23</span>
                                    </td>
                                    <td>
                                        <span>13</span>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <span>A4636</span>
                                    </td>
                                    <td>
                                        <span>131</span>
                                    </td>
                                    <td>
                                        <span>37</span>
                                    </td>
                                    <td>
                                        <span>21</span>
                                    </td>
                                    <td>
                                        <span>29</span>
                                    </td>
                                    <td>
                                        <span>23</span>
                                    </td>
                                    <td>
                                        <span>13</span>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <span>A4636</span>
                                    </td>
                                    <td>
                                        <span>131</span>
                                    </td>
                                    <td>
                                        <span>37</span>
                                    </td>
                                    <td>
                                        <span>21</span>
                                    </td>
                                    <td>
                                        <span>29</span>
                                    </td>
                                    <td>
                                        <span>23</span>
                                    </td>
                                    <td>
                                        <span>13</span>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <span>A4636</span>
                                    </td>
                                    <td>
                                        <span>131</span>
                                    </td>
                                    <td>
                                        <span>37</span>
                                    </td>
                                    <td>
                                        <span>21</span>
                                    </td>
                                    <td>
                                        <span>29</span>
                                    </td>
                                    <td>
                                        <span>23</span>
                                    </td>
                                    <td>
                                        <span>13</span>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <span>A4636</span>
                                    </td>
                                    <td>
                                        <span>131</span>
                                    </td>
                                    <td>
                                        <span>37</span>
                                    </td>
                                    <td>
                                        <span>21</span>
                                    </td>
                                    <td>
                                        <span>29</span>
                                    </td>
                                    <td>
                                        <span>23</span>
                                    </td>
                                    <td>
                                        <span>13</span>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <span>A4636</span>
                                    </td>
                                    <td>
                                        <span>131</span>
                                    </td>
                                    <td>
                                        <span>37</span>
                                    </td>
                                    <td>
                                        <span>21</span>
                                    </td>
                                    <td>
                                        <span>29</span>
                                    </td>
                                    <td>
                                        <span>23</span>
                                    </td>
                                    <td>
                                        <span>13</span>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <span>A4636</span>
                                    </td>
                                    <td>
                                        <span>131</span>
                                    </td>
                                    <td>
                                        <span>37</span>
                                    </td>
                                    <td>
                                        <span>21</span>
                                    </td>
                                    <td>
                                        <span>29</span>
                                    </td>
                                    <td>
                                        <span>23</span>
                                    </td>
                                    <td>
                                        <span>13</span>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <span>A4636</span>
                                    </td>
                                    <td>
                                        <span>131</span>
                                    </td>
                                    <td>
                                        <span>37</span>
                                    </td>
                                    <td>
                                        <span>21</span>
                                    </td>
                                    <td>
                                        <span>29</span>
                                    </td>
                                    <td>
                                        <span>23</span>
                                    </td>
                                    <td>
                                        <span>13</span>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <span>A4636</span>
                                    </td>
                                    <td>
                                        <span>131</span>
                                    </td>
                                    <td>
                                        <span>37</span>
                                    </td>
                                    <td>
                                        <span>21</span>
                                    </td>
                                    <td>
                                        <span>29</span>
                                    </td>
                                    <td>
                                        <span>23</span>
                                    </td>
                                    <td>
                                        <span>13</span>
                                    </td>
                                </tr>

                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-3 col-md-12">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="card card-block card-stretch border-2 card-height border-radius-12">
                            <div class="card-body">
                                <div class="row g-3 align-items-center">
                                    <div class="col-4">
                                        <img src="{{asset('assets/images/group-user.png')}}" class="img-fluid">
                                    </div>
                                    <div class="col-8">
                                        <div class="text-end">
                                            <h6 class="mb-0 text-muted text-capitalize">Industry Update</h6>
                                            <h2 class="text-dark text-capitalize fw-bold text-end">4,423</h2>
                                        </div>
                                    </div>
                                    <div class="col-lg-12">
                                        <div>
                                            <div class="d-flex align-items justify-content-between pb-3">
                                                <div>
                                                    <p class="mb-0 text-capitalize text-ind">Industry Update</p>
                                                </div>
                                                <div>
                                                    <p class="mb-0 text-capitalize text-ind">34% </p>
                                                </div>
                                            </div>
                                            <div class="progress bg-progress border-radius-12" style="height: 10px;">
                                                <div class="progress-bar w-75 border-radius-12 bg-green" role="progressbar" aria-valuenow="75" aria-valuemin="0" aria-valuemax="100"></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-12">
                        <div class="card card-block card-stretch border-2 card-height border-radius-12">
                            <div class="card-body pt-3 pb-3">
                                <div class="row g-3 align-items-center">
                                    <div class="col-8">
                                        <div>
                                            <h6 class="text-muted text-capitalize">Industry Update</h6>
                                            <h2 class="text-dark text-capitalize fw-bold">89.20 M</h2>
                                        </div>
                                        <div class="d-flex align-items-center">
                                            <div>
                                                <img src="{{asset('assets/images/stats-down.png')}}" class="img-fluid w-20s">
                                            </div>
                                            <div class="ms-3">
                                                <p class="mb-0 text-dark text-capitalize fs-5">
                                                    <span class="text-red fw-bold">4.3%</span> Down
                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-4">
                                        <img src="{{asset('assets/images/graph-show.png')}}" class="img-fluid">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-12">
                        <div class="card card-block card-stretch border-2 card-height border-radius-12">
                            <div class="card-body pt-3 pb-3">
                                <div class="row g-3 align-items-center">
                                    <div class="col-8">
                                        <div>
                                            <h6 class="text-muted text-capitalize">Industry Update</h6>
                                            <h2 class="text-dark text-capitalize fw-bold">324.4 K</h2>
                                        </div>
                                        <div class="d-flex align-items-center">
                                            <div>
                                                <img src="{{asset('assets/images/stats-up.png')}}" class="img-fluid w-20s">
                                            </div>
                                            <div class="ms-3">
                                                <p class="mb-0 text-dark text-capitalize fs-5">
                                                    <span class="text-green fw-bold">1.8%</span> up
                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-4">
                                        <img src="{{asset('assets/images/clock-revise.png')}}" class="img-fluid">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-12">
                        <div class="card card-block card-stretch border-2 card-height border-radius-12">
                            <div class="card-body pt-3 pb-3">
                                <div class="row g-3 align-items-center">
                                    <div class="col-8">
                                        <div>
                                            <h6 class="text-muted text-capitalize">Industry Update</h6>
                                            <h2 class="text-dark text-capitalize fw-bold">3%</h2>
                                        </div>
                                        <div class="d-flex align-items-center">
                                            <div>
                                                <img src="{{asset('assets/images/stats-down.png')}}" class="img-fluid w-20s">
                                            </div>
                                            <div class="ms-3">
                                                <p class="mb-0 text-dark text-capitalize fs-5">
                                                    <span class="text-red fw-bold">6%</span> down
                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-4">
                                        <img src="{{asset('assets/images/user-2.png')}}" class="img-fluid">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>


                    <div class="col-lg-12">
                        <div class="card card-block card-stretch border-2 card-height border-radius-12">
                            <div class="card-body pt-3 pb-3">
                                <div class="row g-3 align-items-center">
                                    <div class="col-8">
                                        <div>
                                            <h6 class="text-muted text-capitalize">Industry Update</h6>
                                            <h2 class="text-dark text-capitalize fw-bold">12.20 K</h2>
                                        </div>
                                        <div class="d-flex align-items-center">
                                            <div>
                                                <img src="{{asset('assets/images/stats-up.png')}}" class="img-fluid w-20s">
                                            </div>
                                            <div class="ms-3">
                                                <p class="mb-0 text-dark text-capitalize fs-5">
                                                    <span class="text-green fw-bold">1.1%</span> up
                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-4">
                                        <img src="{{asset('assets/images/chart-graph.png')}}" class="img-fluid">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>


                    <div class="col-lg-12">
                        <div class="card card-block card-stretch border-2 card-height border-radius-12">
                            <div class="card-body pt-3 pb-3">
                                <div class="row g-3 align-items-center">
                                    <div class="col-8">
                                        <div>
                                            <h6 class="text-muted text-capitalize">Industry Update</h6>
                                            <h2 class="text-dark text-capitalize fw-bold">2.4%</h2>
                                        </div>
                                        <div class="d-flex align-items-center">
                                            <div>
                                                <img src="{{asset('assets/images/stats-down.png')}}" class="img-fluid w-20s">
                                            </div>
                                            <div class="ms-3">
                                                <p class="mb-0 text-dark text-capitalize fs-5">
                                                    <span class="text-red fw-bold">4.3%</span> down
                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-4">
                                        <img src="{{asset('assets/images/cart-icon.png')}}" class="img-fluid">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>


                    <div class="col-lg-12">
                        <div class="card card-block card-stretch border-2 card-height border-radius-12">
                            <div class="card-body pt-3 pb-3">
                                <div class="row g-3 align-items-center">
                                    <div class="col-8">
                                        <div>
                                            <h6 class="text-muted text-capitalize">Industry Update</h6>
                                            <h2 class="text-dark text-capitalize fw-bold">84.20 %</h2>
                                        </div>
                                        <div class="d-flex align-items-center">
                                            <div>
                                                <img src="{{asset('assets/images/stats-up.png')}}" class="img-fluid w-20s">
                                            </div>
                                            <div class="ms-3">
                                                <p class="mb-0 text-dark text-capitalize fs-5">
                                                    <span class="text-green fw-bold">7.0%</span> up
                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-4">
                                        <img src="{{asset('assets/images/cart-icon.png')}}" class="img-fluid">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
