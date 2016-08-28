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
                                <th>{{trans('messages.name')}}</th>
                                <th>{{trans('messages.email')}}</th>
                                <th>{{trans('messages.created_at')}}</th>
                                <th>{{trans('messages.updated_at')}}</th>
                                <th>{{trans('messages.option')}}</th>
                            </tr>
                            </thead>
                            <tfoot>
                            <tr>
                                <th>{{trans('messages.name')}}</th>
                                <th>{{trans('messages.email')}}</th>
                                <th>{{trans('messages.created_at')}}</th>
                                <th>{{trans('messages.updated_at')}}</th>
                                <th>{{trans('messages.option')}}</th>
                            </tr>
                            </tfoot>
                            <tbody>
                            @if(!empty($data))
                                @foreach($data as $d)
                                    <tr>
                                        <td>{{$d->name}}</td>
                                        <td>{{$d->email}}</td>
                                        <td>{{$d->created_at}}</td>
                                        <td>{{$d->updated_at}}</td>
                                        <td>
                                            <a href="{{url('users/edit/'.$d->id)}}" class="btn btn-warning btn-xs">{{trans('menu.edit')}}</a>

                                            <a href="#myModal"  class="btn btn-default btn-xs xx" data-id="{{$d->id}}" data-toggle="modal" onclick="teste('{{$d->id}}', '{{$d->name}}')">{{trans('menu.delete')}}</a>
                                        </td>
                                    </tr>
                                @endforeach
                            @endif


                            </tbody>
                        </table>
                    </div>
                </div>
            </div>


            <!-- Modal -->
            <div class="modal fade" name="myModal" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                            <h4 class="modal-title" id="myModalLabel">Modal title</h4>
                        </div>
                        <form method="post" action="{{url('users/delete')}}">
                            <div class="modal-body">
                                <p>Deseja apagar o registro?</p>
                                <div id="name"></div>
                                <input type="hidden" name="id"  id="id" readonly>
                                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                            </div>
                            <div class="modal-footer">
                                <button type="submit" class="btn btn-info">{{trans('menu.save')}}</button>
                                <button type="button" class="btn btn-danger" data-dismiss="modal">{{trans('menu.cancel')}}</button>
                            </div>
                        </form>
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