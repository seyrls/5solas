@include('_header')
<div class="content-wrapper">
    <div class="container-fluid">

        <div class="row">
            <div class="col-md-12">

                <h2 class="page-title">{{trans('messages.list')}}</h2>

                <!-- Zero Configuration Table -->
                <div class="panel panel-default">
                    <div class="panel-heading">{{trans('menu.edit_account')}}</div>
                    <div class="panel-body">
                        <div class="well">
                            <a href="{{url('accounts/add')}}" class="btn btn-info btn-sm">{{trans('menu.add_account')}}</a>
                            <a href="{{url('accounts')}}" class="btn btn-success btn-sm">{{trans('menu.list_account')}}</a>
                        </div>

                        <form method="post" class="form-horizontal" action="{{url('accounts/update')}}">
                            <div class="form-group">
                                <label class="col-sm-2 control-label">{{trans('forms.account_name')}}</label>
                                <div class="col-sm-6 has-error">
                                    <input name="account_name" type="text" value="{{$data->account_name}}" maxlength="45" class="form-control" placeholder="{{trans('forms.account_name')}}" required>
                                    <span class="help-block m-b-none">{{trans('forms.mandatory')}}</span>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-sm-2 control-label">{{trans('forms.balance')}}</label>
                                <div class="col-sm-6 has-error">
                                    <input name="balance" type="text" value="{{$data->balance}}" class="form-control" placeholder="{{trans('forms.balance')}}" required>
                                    <span class="help-block m-b-none">{{trans('forms.mandatory')}}</span>
                                </div>
                            </div>

                            <div class="hr-dashed"></div>
                            <div class="form-group">
                                <div class="col-sm-8 col-sm-offset-2">
                                    <button class="btn btn-info" type="submit">{{trans('menu.save')}}</button>
                                    <button class="btn btn-danger" type="reset">{{trans('menu.cancel')}}</button>
                                </div>
                            </div>
                            <input type="hidden" name="id" value="{{$data->id}}">
                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@include('_footer')