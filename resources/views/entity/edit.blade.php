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
                            <a href="{{url('entities/add')}}" class="btn btn-info btn-sm">{{trans('menu.add_entity')}}</a>
                            <a href="{{url('entities')}}" class="btn btn-success btn-sm">{{trans('menu.list_entity')}}</a>
                        </div>

                        <form method="post" class="form-horizontal" action="{{url('entities/update')}}" enctype="multipart/form-data">
                            <div class="form-group">
                                <label class="col-sm-2 control-label">{{trans('forms.entity_name')}}</label>
                                <div class="col-sm-10">
                                    <input name="name" type="text" value="{{$data->name}}" class="form-control" placeholder="{{trans('forms.entity_name')}}" required>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-sm-2 control-label">{{trans('forms.address')}}</label>
                                <div class="col-sm-10">
                                    <input name="address" type="text" value="{{$data->address}}" class="form-control" placeholder="{{trans('forms.address')}}">
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-sm-2 control-label">{{trans('forms.city')}}</label>
                                <div class="col-sm-6">
                                    <input name="city" type="text" value="{{$data->city}}" class="form-control" placeholder="{{trans('forms.city')}}">
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-sm-2 control-label">{{trans('forms.state')}}</label>
                                <div class="col-sm-4">
                                    <input name="state" type="text" value="{{$data->state}}" class="form-control" placeholder="{{trans('forms.state')}}">
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-sm-2 control-label">{{trans('forms.zip')}}</label>
                                <div class="col-sm-2">
                                    <input name="zip" type="text" value="{{$data->zip}}" class="form-control" placeholder="{{trans('forms.zip')}}">
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-sm-2 control-label">{{trans('forms.telephone')}}</label>
                                <div class="col-sm-2">
                                    <input name="telephone" type="text" value="{{$data->telephone}}" class="form-control" placeholder="{{trans('forms.telephone')}}">
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-sm-2 control-label">{{trans('forms.email')}}</label>
                                <div class="col-sm-8">
                                    <input name="email" type="email" value="{{$data->email}}" class="form-control" placeholder="{{trans('forms.email')}}">
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-sm-2 control-label">{{trans('forms.logo')}}</label>
                                <div class="col-sm-6">
                                    <img src="{{$data->logo}}">
                                    <input name="logo" type="file">
                                    <div id="errorBlock43" class="help-block"></div>
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