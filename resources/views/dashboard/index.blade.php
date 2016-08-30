@include('_header')
<div class="content-wrapper">
    <div class="container-fluid">

        <div class="row">
            <div class="col-md-12">

                <h2 class="page-title">{{trans('messages.dashboard')}}</h2>

                <div class="row">
                    <div class="col-md-12">
                        <div class="row">
                            <div class="col-md-3">
                                <div class="panel panel-default">
                                    <div class="panel-body bk-primary text-light">
                                        <div class="stat-panel text-center">
                                            <div class="stat-panel-number h1 ">{{$member}}</div>
                                            <div class="stat-panel-title text-uppercase">{{trans('messages.members')}}</div>
                                        </div>
                                    </div>
                                    <a href="{{url('/families')}}" class="block-anchor panel-footer">{{trans('messages.details')}} <i class="fa fa-arrow-right"></i></a>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="panel panel-default">
                                    <div class="panel-body bk-success text-light">
                                        <div class="stat-panel text-center">
                                            <div class="stat-panel-number h1 ">{{trans('forms.symbol_money') . number_format($balance,2)}}</div>
                                            <div class="stat-panel-title text-uppercase">{{trans('messages.balances')}} / {{date('F , Y')}}</div>
                                        </div>
                                    </div>
                                    <a href="{{url('/accounts')}}" class="block-anchor panel-footer text-center">{{trans('messages.details')}} <i class="fa fa-arrow-right"></i></a>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="panel panel-default">
                                    <div class="panel-body bk-info text-light">
                                        <div class="stat-panel text-center">
                                            <div class="stat-panel-number h1 ">{{trans('forms.symbol_money') . number_format($expense,2)}}</div>
                                            <div class="stat-panel-title text-uppercase">{{trans('messages.amount_expenses')}} / {{date('F , Y')}}</div>
                                        </div>
                                    </div>
                                    <a href="{{url('/expenses')}}" class="block-anchor panel-footer text-center">{{trans('messages.details')}} <i class="fa fa-arrow-right"></i></a>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="panel panel-default">
                                    <div class="panel-body bk-warning text-light">
                                        <div class="stat-panel text-center">
                                            <div class="stat-panel-number h1 ">{{trans('forms.symbol_money') . number_format($tithes,2)}}</div>
                                            <div class="stat-panel-title text-uppercase">{{trans('messages.amount_tithes')}} / {{date('F , Y')}}</div>
                                        </div>
                                    </div>
                                    <a href="{{url('/tithes')}}" class="block-anchor panel-footer text-center">{{trans('messages.details')}} <i class="fa fa-arrow-right"></i></a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <div class="panel panel-default">
                            <div class="panel-heading">{{trans('messages.amount_tithes')}} / {{date('Y')}}</div>
                            <div class="panel-body">
                                <canvas id="bars" width="400" height="300"></canvas>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="panel panel-default">
                            <div class="panel-heading">{{trans('messages.balances')}} , {{trans('messages.amount_expenses')}} , {{trans('messages.amount_tithes')}} / {{date('Y')}}</div>
                            <div class="panel-body">
                                <canvas id="pie" width="400" height="300"></canvas>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    var ctx = document.getElementById("bars");
    var data = {
        labels: [
            "{{$month[0]->month}}",
            "{{$month[1]->month}}",
            "{{$month[2]->month}}",
            "{{$month[3]->month}}",
            "{{$month[4]->month}}",
            "{{$month[5]->month}}",
            "{{$month[6]->month}}",
            "{{$month[7]->month}}",
            "{{$month[8]->month}}",
            "{{$month[9]->month}}",
            "{{$month[10]->month}}",
            "{{$month[11]->month}}"
        ],
        datasets: [
            {
                label: "{{trans('messages.amount_tithes')}}",
                backgroundColor: [
                    'rgba(147,197,75, 0.7)',
                    'rgba(41,171,224, 0.7)',
                    'rgba(244,124,60, 0.7)',
                    'rgba(216,122,104, 0.7)',
                    'rgba(32,80,129, 0.7)',
                    'rgba(16,135,221, 0.7)',
                    'rgba(59,89,152, 0.7)',
                    'rgba(255,0,132, 0.7)',
                    'rgba(249,72,119, 0.7)',
                    'rgba(43,43,43, 0.7)',
                    'rgba(221,75,57, 0.7)',
                    'rgba(63,114,155, 0.7)',
                ],
                hoverBackgroundColor: [
                    'rgba(147,197,75, 1)',
                    'rgba(41,171,224, 1)',
                    'rgba(244,124,60, 1)',
                    'rgba(216,122,104, 1)',
                    'rgba(32,80,129, 1)',
                    'rgba(16,135,221, 1)',
                    'rgba(59,89,152, 1)',
                    'rgba(255,0,132, 1)',
                    'rgba(249,72,119, 1)',
                    'rgba(43,43,43, 1)',
                    'rgba(221,75,57, 1)',
                    'rgba(63,114,155, 1)',
                ],
                data: [
                    {{$month[0]->total}},
                    {{$month[1]->total}},
                    {{$month[2]->total}},
                    {{$month[3]->total}},
                    {{$month[4]->total}},
                    {{$month[5]->total}},
                    {{$month[6]->total}},
                    {{$month[7]->total}},
                    {{$month[8]->total}},
                    {{$month[9]->total}},
                    {{$month[10]->total}},
                    {{$month[11]->total}}
                ],
            }
        ]
    };
    var myBarChart = new Chart(ctx, {
        type: 'bar',
        data: data
    });
</script>

<script>
    var ctx = document.getElementById("pie");

    var data = {
        labels: [
            "{{trans('messages.balances')}}",
            "{{trans('messages.amount_expenses')}}",
            "{{trans('messages.amount_tithes')}}"
        ],
        datasets: [
            {
                data: [
                    {{number_format((($balance / ($balance+$expense+$tithes))*100),2)}},
                    {{number_format((($expense / ($balance+$expense+$tithes))*100),2)}},
                    {{number_format((($tithes / ($balance+$expense+$tithes))*100),2)}},
                ],
                backgroundColor: [
                    'rgba(147,197,75, 0.7)',
                    'rgba(41,171,224, 0.7)',
                    'rgba(244,124,60, 0.7)',
                ],
                hoverBackgroundColor: [
                    'rgba(147,197,75, 1)',
                    'rgba(41,171,224, 1)',
                    'rgba(244,124,60, 1)',
                ]
            }]
    };

    // For a pie chart
    var myPieChart = new Chart(ctx,{
        type: 'pie',
        data: data,

    });

</script>

@include('_footer')