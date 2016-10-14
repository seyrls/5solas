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
                            <a href="{{url('members/add')}}" class="btn btn-info btn-sm">{{trans('menu.add_member')}}</a>
                            <a href="{{url('members')}}" class="btn btn-success btn-sm">{{trans('menu.list_member')}}</a>
                        </div>

                        <form method="post" class="form-horizontal" action="{{url('members/update')}}" enctype="multipart/form-data">

                            <div class="form-group">
                                <label class="col-sm-2 control-label">{{trans('forms.family_name')}}</label>
                                <div class="col-sm-10">

                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-sm-2 control-label">{{trans('forms.member_name')}}</label>
                                <div class="col-sm-10">
                                    <input name="name" type="text" value="{{$data->name}}" class="form-control" placeholder="{{trans('forms.member_name')}}" disabled>
                                </div>
                            </div>


                            <div class="form-group">
                                <label class="col-sm-2 control-label">{{trans('forms.birthday')}}</label>
                                <div class="col-sm-2">
                                    <input name="birthday" value="{{$data->birthday}}" type="date" class="form-control" disabled>
                                </div>
                            </div>


                            <div class="form-group">
                                <label class="col-sm-2 control-label">{{trans('forms.telephone')}}</label>
                                <div class="col-sm-2">
                                    <input name="telephone" id="telephone" value="{{$data->telephone}}" type="text" class="form-control" placeholder="{{trans('forms.phone_placeholder')}}" disabled>
                                    <span class="help-block m-b-none">{{trans('forms.phone_placeholder')}}</span>
                                </div>
                            </div>


                            <div class="form-group">
                                <label class="col-sm-2 control-label">{{trans('forms.cellphone')}}</label>
                                <div class="col-sm-2">
                                    <input name="cellphone" value="{{$data->cellphone}}" type="text" class="form-control" placeholder="{{trans('forms.phone_placeholder')}}" disabled>
                                    <span class="help-block m-b-none">{{trans('forms.phone_placeholder')}}</span>
                                </div>
                            </div>


                            <div class="form-group">
                                <label class="col-sm-2 control-label">{{trans('forms.email')}}</label>
                                <div class="col-sm-6">
                                    <input name="email" type="email" value="{{$data->email}}" class="form-control" placeholder="{{trans('forms.email_placeholder')}}" disabled>
                                    <span class="help-block m-b-none">{{trans('forms.email_placeholder')}}</span>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-sm-2 control-label">{{trans('forms.gender')}}</label>
                                <div class="col-sm-10">
                                    <select class="selectpicker" data-selected-text-format="count" name="gender" disabled>
                                        @if ($data->gender == "m")
                                            <option value="m" selected>{{trans('forms.male')}}</option>
                                            <option value="f">{{trans('forms.female')}}</option>
                                        @else
                                            <option value="m">{{trans('forms.male')}}</option>
                                            <option value="f" selected>{{trans('forms.female')}}</option>
                                        @endif
                                    </select>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-sm-2 control-label">{{trans('forms.image')}}</label>
                                <div class="col-sm-6">
                                    <img src="{{$data->image}}">
                                </div>
                            </div>

                            <input type="hidden" name="id" value="{{$data->id}}">
                            <input type="hidden" name="status" value="1">

                            <div class="hr-dashed"></div>
                            <div class="form-group">
                                <div class="col-sm-8 col-sm-offset-2">
                                    <a class="btn btn-info" onclick="javascript:window.print();">{{trans('menu.print')}}</a>
                                    <a class="btn btn-danger" href="{{URL::previous()}}">{{trans('menu.cancel')}}</a>
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