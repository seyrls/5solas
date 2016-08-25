@include('_header')
<div class="content-wrapper">
    <div class="container-fluid">

        <div class="row">
            <div class="col-md-12">

                <h2 class="page-title">{{trans('messages.list')}}</h2>

                <!-- Zero Configuration Table -->
                <div class="panel panel-default">
                    <div class="panel-heading">{{trans('messages.details')}}</div>
                    <div class="panel-body">
                        <div class="well">
                            <a href="{{url('users/add')}}" class="btn btn-info btn-sm">{{trans('menu.add_user')}}</a>
                            <a href="{{url('users')}}" class="btn btn-success btn-sm">{{trans('menu.list_user')}}</a>
                        </div>

                        <form method="post" class="form-horizontal" action="{{url('users/save')}}">
                            <div class="form-group">
                                <label class="col-sm-2 control-label">{{trans('forms.user_name')}}</label>
                                <div class="col-sm-6 has-error">
                                    <input name="name" type="text" class="form-control" placeholder="{{trans('forms.user_name')}}" required>
                                    <span class="help-block m-b-none">{{trans('forms.mandatory')}}</span>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-sm-2 control-label">{{trans('forms.user_email')}}</label>
                                <div class="col-sm-6 has-error">
                                    <input name="email" type="email" class="form-control" placeholder="{{trans('forms.user_email')}}" required>
                                    <span class="help-block m-b-none">{{trans('forms.mandatory')}}</span>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-sm-2 control-label">{{trans('forms.user_password')}}</label>
                                <div class="col-sm-6 has-error">
                                    <input name="password" type="password" class="form-control" placeholder="{{trans('forms.user_password')}}" required>
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

                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@include('_footer')