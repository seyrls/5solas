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
                            <a href="{{url('families/add')}}" class="btn btn-info btn-sm">{{trans('menu.add_family')}}</a>
                            <a href="{{url('families')}}" class="btn btn-success btn-sm">{{trans('menu.list_family')}}</a>
                        </div>

                        <form method="post" class="form-horizontal" action="{{url('families/update')}}">
                            <div class="form-group">
                                <label class="col-sm-2 control-label">{{trans('forms.family_name')}}</label>
                                <div class="col-sm-10">
                                    <input name="name" type="text" value="{{$data->name}}" class="form-control" placeholder="{{trans('forms.family_name')}}" required>
                                </div>
                            </div>
                            <div class="hr-dashed"></div>
                            <div class="form-group">
                                <label class="col-sm-2 control-label">{{trans('forms.address')}}</label>
                                <div class="col-sm-10">
                                    <input name="address" type="text" value="{{$data->address}}" class="form-control" placeholder="{{trans('forms.address')}}">
                                </div>
                            </div>

                            <div class="hr-dashed"></div>
                            <div class="form-group">
                                <div class="col-sm-8 col-sm-offset-2">
                                    <button class="btn btn-warning" type="submit">{{trans('menu.edit')}}</button>
                                    <button class="btn btn-danger" type="reset">{{trans('menu.cancel')}}</button>
                                </div>
                            </div>

                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                            <input type="hidden" name="id" value="{{ $data->id }}">
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@include('_footer')