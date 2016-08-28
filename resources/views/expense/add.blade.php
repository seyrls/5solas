@include('_header')

<div class="content-wrapper">
    <div class="container-fluid">

        <div class="row">
            <div class="col-md-12">

                <h2 class="page-title">{{trans('messages.list')}}</h2>

                <!-- Zero Configuration Table -->
                <div class="panel panel-default">
                    <div class="panel-heading">{{trans('menu.add_expense')}}</div>
                    <div class="panel-body">
                        <div class="well">
                            <a href="{{url('expenses/add')}}" class="btn btn-info btn-sm">{{trans('menu.add_expense')}}</a>
                            <a href="{{url('expenses')}}" class="btn btn-success btn-sm">{{trans('menu.list_expense')}}</a>
                        </div>

                        <form method="post" class="form-horizontal" action="{{url('expenses/save')}}">

                            <div class="form-group">
                                <label class="col-sm-2 control-label">{{trans('forms.category_name')}}</label>
                                <div class="col-sm-10">
                                    {!! $category !!}
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-sm-2 control-label">{{trans('forms.subcategory_name')}}</label>
                                <div class="col-sm-10" id="subcategory"></div>
                            </div>

                            <div class="form-group">
                                <label class="col-sm-2 control-label">{{trans('forms.account_name')}}</label>
                                <div class="col-sm-10">
                                    {!! $account !!}
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-sm-2 control-label">{{trans('forms.description')}}</label>
                                <div class="col-sm-10">
                                    <input name="description" type="text" class="form-control" placeholder="{{trans('forms.description')}}" required>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-sm-2 control-label">{{trans('forms.amount')}}</label>
                                <div class="col-sm-2">
                                    <input name="amount" type="text" class="form-control" placeholder="{{trans('forms.amount')}}" required>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-sm-2 control-label">{{trans('forms.date')}}</label>
                                <div class="col-sm-2">
                                    <input name="date" type="date" class="form-control" placeholder="{{trans('forms.date')}}" required>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-sm-2 control-label">{{trans('forms.observation')}}</label>
                                <div class="col-sm-8">
                                    <input name="observation" type="text" class="form-control" placeholder="{{trans('forms.observation')}}">
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-sm-2 control-label">{{trans('forms.tag')}}</label>
                                <div class="col-sm-6">
                                    <input name="tag" type="text" class="form-control" placeholder="{{trans('forms.tag')}}">
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