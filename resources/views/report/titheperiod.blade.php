@include('_header')
<div class="content-wrapper">
    <div class="container-fluid">

        <div class="row">
            <div class="col-md-12">

                <h2 class="page-title">{{trans('messages.tithes') .' , '.date('Y')}}</h2>

                <!-- Zero Configuration Table -->
                <div class="panel panel-default">
                    <div class="panel-heading">{{trans('messages.tithes')}}</div>
                    <div class="panel-body">
                        <div class="well">
                            <a href="{{url('reports/tithesmember')}}" class="btn btn-info btn-sm">{{trans('menu.tithes_member')}}</a>
                            <a href="{{url('reports/tithesperiod')}}" class="btn btn-success btn-sm">{{trans('menu.tithes_period')}}</a>
                        </div>

                        <div class="well">
                            <form method="post" class="form-horizontal" action="{{url('reports/tithesperiod')}}">
                                <div class="form-group">
                                    <label class="col-sm-2 control-label">{{trans('messages.period')}}</label>
                                    <div class="col-sm-10">
                                        <div class="row">
                                            <div class="col-xs-2">
                                                <input type="date" name="initialdate" class="form-control" placeholder=".col-xs-2">
                                            </div>
                                            <div class="col-xs-2">
                                                <input type="date" name="finaldate" class="form-control" placeholder=".col-xs-2">
                                            </div>
                                            <div class="col-xs-4">
                                                <button class="btn btn-info" type="submit">{{trans('menu.save')}}</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                            </form>
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

                        <table id="table-tithe" class="display table table-striped table-bordered table-hover datatable" cellspacing="0" width="100%">
                            <thead>
                            <tr>
                                <th>{{trans('messages.amount')}}</th>
                                <th>{{trans('messages.period')}}</th>
                                <th>{{trans('messages.created_at')}}</th>
                            </tr>
                            </thead>
                            <tfoot>
                            <tr>
                                <th colspan="1" style="text-align:right">Total:</th>
                                <th></th>
                                <th></th>
                            </tr>
                            </tfoot>
                            <tbody>
                            @if(!empty($data))
                                @foreach($data as $d)
                                    <tr>
                                        <td>{{number_format($d->amount,2)}}</td>
                                        <td>{{$d->period}}</td>
                                        <td>{{$d->created_at}}</td>
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



@include('_footer')

<script>
$(document).ready(function() {
    $('#table-tithe').DataTable( {
        "footerCallback": function ( row, data, start, end, display ) {
            var api = this.api(), data;
 
            // Remove the formatting to get integer data for summation
            var intVal = function ( i ) {
                return typeof i === 'string' ?
                    i.replace(/[\$,]/g, '')*1 :
                    typeof i === 'number' ?
                        i : 0;
            };
 
            // Total over all pages
            total = api
                .column( 0 )
                .data()
                .reduce( function (a, b) {
                    return intVal(a) + intVal(b);
                }, 0 );
 
            // Total over this page
            pageTotal = api
                .column( 0, { page: 'current'} )
                .data()
                .reduce( function (a, b) {
                    return intVal(a) + intVal(b);
                }, 0 );
 
            // Update footer
            $( api.column( 0 ).footer() ).html(
                'Total: {{trans('forms.symbol_money')}}'+ total
            );
        }
    } );
} );
</script>