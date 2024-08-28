@extends('layouts.app')

@section('content')
    <div class="page-body">
        <!-- Container-fluid starts-->
        <div class="col-sm-12 p-1">
            <div class="d-flex justify-content-between align-items-center m-4">
                <div>
                    <b>
                        <h5>Dashboard</h5>
                    </b>
                </div>
            </div>
            <div class="container-fluid">
                <div class="row second-chart-list third-news-update">
                    <div class="col-xl-4 col-lg-12 xl-50 morning-sec box-col-12">
                        <div class="card profile-greeting">
                            <div class="card-body pb-0">
                                <div class="media">
                                    <div class="media-body">
                                        <div class="greeting-user">
                                            <h4 class="f-w-600 font-primary" id="greeting"></h4>
                                            <p>Here you could manage all of Dance Connect data</p>
                                        </div>
                                    </div>
                                    <div class="badge-groups">
                                        <div class="badge f-10"><i class="me-1" data-feather="clock"></i><span
                                                id="txt"></span></div>
                                    </div>
                                </div>
                                <div class="cartoon"><img class="img-fluid" src="../assets/images/dashboard/cartoon.png"
                                        alt=""></div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-9 xl-100 chart_data_left box-col-12">
                        <div class="card">
                            <div class="card-body p-0">
                                <div class="row m-0 chart-main">
                                    <div class="col-xl-4 col-md-6 col-sm-6 p-0 box-col-6">
                                        <div class="media align-items-center">
                                            <div class="hospital-small-chart">
                                                <div class="small-bar">
                                                    <div class="small-chart flot-chart-container"></div>
                                                </div>
                                            </div>
                                            <div class="media-body">
                                                <div class="right-chart-content">
                                                    <h4>{{ $totalClasses }}</h4><span>Classes</span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-xl-4 col-md-6 col-sm-6 p-0 box-col-6">
                                        <div class="media align-items-center">
                                            <div class="hospital-small-chart">
                                                <div class="small-bar">
                                                    <div class="small-chart1 flot-chart-container"></div>
                                                </div>
                                            </div>
                                            <div class="media-body">
                                                <div class="right-chart-content">
                                                    <h4>{{ $totalTutors }}</h4><span>Tutors</span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-xl-4 col-md-6 col-sm-6 p-0 box-col-6">
                                        <div class="media align-items-center">
                                            <div class="hospital-small-chart">
                                                <div class="small-bar">
                                                    <div class="small-chart2 flot-chart-container"></div>
                                                </div>
                                            </div>
                                            <div class="media-body">
                                                <div class="right-chart-content">
                                                    <h4>{{ $totalStudios }}</h4><span>Studios</span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div id="chart-widget3"></div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-3 xl-100 chart_data_right box-col-12">
                        <div class="card">
                            <div class="card-body">
                                <div class="media align-items-center">
                                    <div class="media-body right-chart-content">
                                        <h4>{{ 'Rp ' . number_format($totalTransactionAmount, 0, ',', '.') }}<span
                                                class="new-box">All</span></h4><span>Total Earnings</span>
                                    </div>
                                    {{-- <div class="knob-block text-center">
                                        <input class="knob1" data-width="50" data-height="70" data-thickness=".3"
                                            data-fgcolor="#7366ff" data-linecap="round" data-angleoffset="0"
                                            value="{{ $completionPercentage }}" data-readonly="true">
                                    </div> --}}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Container-fluid Ends-->
    </div>
@endsection
