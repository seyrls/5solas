@include('_header')
<div class="content-wrapper">
    <div class="container-fluid">

        <div class="row">
            <div class="col-md-12">

                <h2 class="page-title">{{trans('messages.tithes_of').' '.$member->name .' , '.date('Y')}}</h2>

                <!-- Zero Configuration Table -->
                <div class="panel panel-default">
                    <div class="panel-heading">{{trans('messages.tithes')}}</div>
                    <div class="panel-body">
                        <div class="well">
                            <a href="{{url('reports/tithesmember')}}" class="btn btn-info btn-sm">{{trans('menu.tithes_member')}}</a>
                            <a href="{{url('reports/tithesperiod')}}" class="btn btn-success btn-sm">{{trans('menu.tithes_period')}}</a>
                        </div>

                        @if($errors->any())
                            <div class="alert alert-dismissible alert-danger">
                                <button type="button" class="close" data-dismiss="alert"><i class="fa fa-remove"></i></button>
                                @foreach($errors->all() as $error)
                                    <strong>{{ $error }}</strong>
                                @endforeach
                            </div>
                        @endif

                        @if (!empty($msg))
                            @if($msg == true)
                                <div class="alert alert-dismissible alert-success">
                                    <button type="button" class="close" data-dismiss="alert"><i class="fa fa-remove"></i></button>
                                    <strong>{{trans('messages.save')}}</strong>
                                </div>
                            @else
                                <div class="alert alert-dismissible alert-danger">
                                    <button type="button" class="close" data-dismiss="alert"><i class="fa fa-remove"></i></button>
                                    <strong>{{trans('messages.fail')}}</strong>
                                </div>
                            @endif
                        @endif

                        <table id="zctb" class="display table table-striped table-bordered table-hover" cellspacing="0" width="100%">
                            <thead>
                            <tr>
                                <th>{{trans('messages.amount')}}</th>
                                <th>{{trans('messages.period')}}</th>
                                <th>{{trans('messages.created_at')}}</th>
                                <th>{{trans('messages.updated_at')}}</th>
                            </tr>
                            </thead>
                            <tfoot>
                            <tr>
                                <th>{{trans('messages.amount')}}</th>
                                <th>{{trans('messages.period')}}</th>
                                <th>{{trans('messages.created_at')}}</th>
                                <th>{{trans('messages.updated_at')}}</th>
                            </tr>
                            </tfoot>
                            <tbody>
                            @if(!empty($tithes))
                                @foreach($tithes as $d)
                                    <tr>
                                        <td>{{trans('forms.symbol_money') . number_format($d->amount,2)}}</td>
                                        <td>{{$d->period}}</td>
                                        <td>{{$d->created_at}}</td>
                                        <td>{{$d->updated_at}}</td>
                                    </tr>
                                @endforeach
                            @endif
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>

@include('_footer')