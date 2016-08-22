@include("_header")
<div class="content-wrapper">
    <div class="container-fluid">

        <div class="row">
            <div class="col-md-12">

                <h2 class="page-title">{{trans('login.title')}}</h2>

                <div class="row">
                    <div class="col-md-6">
                        <div class="panel panel-default">
                            <div class="panel-heading">{{trans('login.title')}}</div>
                            <div class="panel-body">
                                <form method="get" class="form-horizontal">
                                    <div class="form-group">
                                        <label class="col-sm-2 control-label">{{trans('login.name')}}</label>
                                        <div class="col-sm-10">
                                            <input type="text" class="form-control" value="{{$user->name}}">
                                        </div>
                                    </div>
                                    <div class="hr-dashed"></div>
                                    <div class="form-group">
                                        <label class="col-sm-2 control-label">{{trans('login.username')}}</label>
                                        <div class="col-sm-10">
                                            <input type="text" class="form-control" value="{{$user->email}}"><span class="help-block m-b-none">A block of help text that breaks onto a new line and may extend beyond one line.</span> </div>
                                    </div>

                                    <div class="hr-dashed"></div>
                                    <div class="form-group">
                                        <label class="col-sm-2 control-label">{{trans('login.created_at')}}</label>
                                        <div class="col-sm-10">
                                            <input type="text" class="form-control" value="{{$user->created_at}}"></div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

@include("_footer")