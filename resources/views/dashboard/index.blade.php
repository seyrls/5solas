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
                                {!! $expenses->render() !!}
                            </div>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="panel panel-default">
                            <div class="panel-heading">{{trans('messages.amount_tithes') . "/" . date('Y')}}</div>
                            <div class="panel-body">
                                {!!($chart->render())!!}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@include('_footer')