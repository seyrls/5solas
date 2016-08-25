@include('_header')
<div class="content-wrapper">
    <div class="container-fluid">

        <div class="row">
            <div class="col-md-12">

                <h2 class="page-title">{{trans('messages.list')}}</h2>

                <!-- Zero Configuration Table -->
                <div class="panel panel-default">
                    <div class="panel-heading">{{trans('menu.add_tithe')}}</div>
                    <div class="panel-body">
                        <div class="well">
                            <a href="{{url('tithes/add')}}" class="btn btn-info btn-sm">{{trans('menu.add_tithe')}}</a>
                            <a href="{{url('tithes')}}" class="btn btn-success btn-sm">{{trans('menu.list_tithe')}}</a>
                        </div>

                        <form method="post" class="form-horizontal" action="{{url('tithes/save')}}">
                            <div class="form-group">
                                <label class="col-sm-2 control-label">{{trans('forms.period')}}</label>
                                <div class="col-sm-2">
                                    <input name="period" type="date" class="form-control">
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-sm-2 control-label">{{trans('forms.type')}}</label>
                                <div class="col-sm-10">
                                    {!! $family !!}
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-sm-2 control-label">{{trans('forms.member_name')}}</label>
                                <div class="col-sm-10" id="member">

                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-sm-2 control-label">{{trans('forms.type')}}</label>
                                <div class="col-sm-10">
                                        {!! $type !!}
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-sm-2 control-label">{{trans('forms.amount')}}</label>
                                <div class="col-sm-2">
                                    <input name="amount" type="text" class="form-control" placeholder="{{trans('forms.amount')}}" required>
                                </div>
                            </div>

                            <div class="hr-dashed"></div>
                            <div class="form-group">
                                <div class="col-sm-8 col-sm-offset-2">
                                    <button class="btn btn-info" type="submit">{{trans('menu.save')}}</button>
                                    <button class="btn btn-danger" type="reset">{{trans('menu.cancel')}}</button>
                                </div>
                            </div>

                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@include('_footer')