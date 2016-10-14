@include('_header')
<div class="content-wrapper">
    <div class="container-fluid">

        <div class="row">
            <div class="col-md-12">

                <h2 class="page-title">{{trans('messages.year_tithes') . date('Y')}}</h2>

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
                                <th>{{trans('messages.family')}}</th>
                                <th>{{trans('messages.member')}}</th>
                                <th>{{trans('messages.total')}}</th>
                                <th>{{trans('messages.option')}}</th>
                            </tr>
                            </thead>
                            <tfoot>
                            <tr>
                                <th>{{trans('messages.family')}}</th>
                                <th>{{trans('messages.member')}}</th>
                                <th>{{trans('messages.total')}}</th>
                                <th>{{trans('messages.option')}}</th>
                            </tr>
                            </tfoot>
                            <tbody>
                            @if(!empty($data))
                                @foreach($data as $d)
                                    <tr>
                                        <td>{{$d->family}}</td>
                                        <td>{{$d->member}}</td>
                                        <td>{{trans('forms.symbol_money') . number_format($d->total,2)}}</td>
                                        <td>
                                            <a href="{{url('reports/tithesdetail/'.$d->member_id)}}" class="btn btn-warning btn-xs">{{trans('menu.detail')}}</a>
                                        </td>
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
<script>
    function teste(val, name) {
        $("#id").val(val);
        $("#name").html('<strong>' + name + '</strong>');
    }
</script>
@include('_footer')