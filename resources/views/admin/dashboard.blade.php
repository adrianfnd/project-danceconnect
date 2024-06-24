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
                    <div class="col-xl-8 xl-100 dashboard-sec box-col-12">
                        <div class="card earning-card">
                            <div class="card-body p-0">
                                <div class="row m-0">
                                    <div class="col-xl-3 earning-content p-0">
                                        <div class="row m-0 chart-left">
                                            <div class="col-xl-12 p-0 left_side_earning">
                                                <h5>Dashboard</h5>
                                                <p class="font-roboto">Overview of this month</p>
                                            </div>
                                            <div class="col-xl-12 p-0 left_side_earning">
                                                <h5>{{ 'Rp ' . number_format($thisMonthEarnings, 0, ',', '.') }}</h5>
                                                <p class="font-roboto">This Month Earning</p>
                                            </div>
                                            <div class="col-xl-12 p-0 left_side_earning">
                                                <h5>{{ number_format($thisMonthPercentage, 0) }}%</h5>
                                                <p class="font-roboto">This Month Earning<br>
                                                    Percentage</p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-xl-9 p-0">
                                        <div class="chart-right">
                                            <div class="row m-0 p-tb">
                                                <div class="col-xl-8 col-md-8 col-sm-8 col-12 p-0">
                                                    <div class="inner-top-left">
                                                        <ul class="d-flex list-unstyled">
                                                            <li class="active">Weekly</li>
                                                        </ul>
                                                    </div>
                                                </div>
                                                <div class="col-xl-4 col-md-4 col-sm-4 col-12 p-0 justify-content-end">
                                                    <div class="inner-top-right">
                                                        <ul class="d-flex list-unstyled justify-content-end">
                                                            <li>Studio</li>
                                                            <li>Tutor</li>
                                                        </ul>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-xl-12">
                                                    <div class="card-body p-0">
                                                        <div class="current-sale-container">
                                                            <canvas id="weeklyEarningsChart"></canvas>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <script>
                                            document.addEventListener('DOMContentLoaded', function() {
                                                const ctx = document.getElementById('weeklyEarningsChart').getContext('2d');

                                                const weeklyEarnings = @json($weeklyEarnings);

                                                const labels = weeklyEarnings.map(earning => 'Week ' + earning.week);
                                                const studioData = weeklyEarnings.map(earning => earning.studio);
                                                const tutorData = weeklyEarnings.map(earning => earning.tutor);

                                                const chart = new Chart(ctx, {
                                                    type: 'bar',
                                                    data: {
                                                        labels: labels,
                                                        datasets: [{
                                                                label: 'Studio Earnings',
                                                                data: studioData,
                                                                backgroundColor: 'rgba(75, 192, 192, 0.6)',
                                                                borderColor: 'rgba(75, 192, 192, 1)',
                                                                borderWidth: 1
                                                            },
                                                            {
                                                                label: 'Tutor Earnings',
                                                                data: tutorData,
                                                                backgroundColor: 'rgba(153, 102, 255, 0.6)',
                                                                borderColor: 'rgba(153, 102, 255, 1)',
                                                                borderWidth: 1
                                                            }
                                                        ]
                                                    },
                                                    options: {
                                                        responsive: true,
                                                        scales: {
                                                            x: {
                                                                title: {
                                                                    display: true,
                                                                    text: 'Week'
                                                                }
                                                            },
                                                            y: {
                                                                title: {
                                                                    display: true,
                                                                    text: 'Earnings'
                                                                },
                                                                beginAtZero: true
                                                            }
                                                        }
                                                    }
                                                });
                                            });
                                        </script>
                                        <div class="row border-top m-0">
                                            @foreach ($earningsByCategory as $category)
                                                <div class="col-xl-4 ps-0 col-md-6 col-sm-6">
                                                    <div class="media p-0">
                                                        <div class="media-left">
                                                            <i class="icofont icofont-crown"></i>
                                                        </div>
                                                        <div class="media-body">
                                                            <h6>{{ ucfirst($category['category']) }} Earnings</h6>
                                                            <p>{{ 'Rp ' . number_format($category['total'], 0, ',', '.') }}
                                                            </p>
                                                        </div>
                                                    </div>
                                                </div>
                                            @endforeach
                                        </div>
                                    </div>
                                </div>
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
                                    <div class="knob-block text-center">
                                        <input class="knob1" data-width="50" data-height="70" data-thickness=".3"
                                            data-fgcolor="#7366ff" data-linecap="round" data-angleoffset="0"
                                            value="{{ $completionPercentage }}" data-readonly="true">
                                    </div>
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
