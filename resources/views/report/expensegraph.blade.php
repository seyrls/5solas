@include('_header')

<div class="content-wrapper">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <h2 class="page-title">{{trans('messages.graphs')}}</h2>
                <div class="row">
                    <div class="col-md-6">
                        <div class="panel panel-default">
                            <div class="panel-heading">{{trans('messages.total_expenses')}}</div>
                            <div class="panel-body">
                                {!!($line->render())!!}
                            </div>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="panel panel-default">
                            <div class="panel-heading">{{trans('messages.amount_tithes')}}</div>
                            <div class="panel-body">
                                {!!($bar->render())!!}
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class="row">
                    <div class="col-md-6">
                        <div class="panel panel-default">
                            <div class="panel-heading">{{trans('messages.last_tithes')}}</div>
                            <div class="panel-body">
                                
                            </div>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="panel panel-default">
                            <div class="panel-heading">{{trans('messages.expense') . " x " . trans('messages.months') . date(' Y')}}</div>
                            <div class="panel-body">
                                
                            </div>
                        </div>
                    </div>
                </div>
                
            </div>
        </div>
    </div>
</div>

@include('_footer')