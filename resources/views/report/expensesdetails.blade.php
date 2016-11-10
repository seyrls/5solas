@include('_header')
<div class="content-wrapper">
    <div class="container-fluid">

        <div class="row">
            <div class="col-md-12">

                <h2 class="page-title">{{trans('messages.year_tithes') . date('Y')}}</h2>

                <!-- Zero Configuration Table -->
                <div class="panel panel-default">
                    <div class="panel-heading">{{trans('messages.tithes')}}</div>
                    <div class="panel-body">
                        <div class="well">
                            <a href="{{url('reports/tithesmember')}}" class="btn btn-info btn-sm">{{trans('menu.tithes_member')}}</a>
                            <a href="{{url('reports/tithesperiod')}}" class="btn btn-success btn-sm">{{trans('menu.tithes_period')}}</a>
                        </div>

                        <table id="zctb" class="display table table-striped table-bordered table-hover" cellspacing="0" width="100%">
                            <thead>
                            <tr>
                                <th>{{trans('messages.category')}}</th>
                                <th>{{trans('messages.subcategory')}}</th>
                                <th>{{trans('messages.JAN')}}</th>
                                <th>{{trans('messages.FEB')}}</th>
                                <th>{{trans('messages.MAR')}}</th>
                                <th>{{trans('messages.APR')}}</th>
                                <th>{{trans('messages.MAY')}}</th>
                                <th>{{trans('messages.JUN')}}</th>
                                <th>{{trans('messages.JUL')}}</th>
                                <th>{{trans('messages.AUG')}}</th>
                                <th>{{trans('messages.SEP')}}</th>
                                <th>{{trans('messages.OCT')}}</th>
                                <th>{{trans('messages.NOV')}}</th>
                                <th>{{trans('messages.DEC')}}</th>
                                <th>{{trans('messages.total')}}</th>
                                <th>{{trans('messages.year')}}</th>
                            </tr>
                            </thead>
                            <tfoot>
                            <tr>
                                <th>{{trans('messages.category')}}</th>
                                <th>{{trans('messages.subcategory')}}</th>
                                <th>{{trans('messages.JAN')}}</th>
                                <th>{{trans('messages.FEB')}}</th>
                                <th>{{trans('messages.MAR')}}</th>
                                <th>{{trans('messages.APR')}}</th>
                                <th>{{trans('messages.MAY')}}</th>
                                <th>{{trans('messages.JUN')}}</th>
                                <th>{{trans('messages.JUL')}}</th>
                                <th>{{trans('messages.AUG')}}</th>
                                <th>{{trans('messages.SEP')}}</th>
                                <th>{{trans('messages.OCT')}}</th>
                                <th>{{trans('messages.NOV')}}</th>
                                <th>{{trans('messages.DEC')}}</th>
                                <th>{{trans('messages.total')}}</th>
                                <th>{{trans('messages.year')}}</th>
                            </tr>
                            </tfoot>
                            <tbody>
                                @php $word="";@endphp
                                @if(!empty($expenses))
                                    @foreach($expenses as $d)
                                        <tr>
                                            @if ($word == "")
                                            <td><strong>{{$d->category}}</strong></td>
                                                @php $word=$expenses[0]->category;@endphp
                                            @endif
                                            @if ($word <> $d->category)
                                            <td rowspan="{{$elements[$d->id]}}"><strong>{{$d->category}}</strong></td>
                                                <td>{{$d->subcategory}}</td>
                                                @php $word=$d->category;@endphp
                                            @else

                                                <td>{{$d->subcategory}}</td>
                                                @php $word=$d->category;@endphp
                                            @endif

                                            <td>{{trans('forms.symbol_money') . number_format($d->JAN,2)}}</td>
                                            <td>{{trans('forms.symbol_money') . number_format($d->FEB,2)}}</td>
                                            <td>{{trans('forms.symbol_money') . number_format($d->MAR,2)}}</td>
                                            <td>{{trans('forms.symbol_money') . number_format($d->APR,2)}}</td>
                                            <td>{{trans('forms.symbol_money') . number_format($d->MAY,2)}}</td>
                                            <td>{{trans('forms.symbol_money') . number_format($d->JUN,2)}}</td>
                                            <td>{{trans('forms.symbol_money') . number_format($d->JUL,2)}}</td>
                                            <td>{{trans('forms.symbol_money') . number_format($d->AUG,2)}}</td>
                                            <td>{{trans('forms.symbol_money') . number_format($d->SEP,2)}}</td>
                                            <td>{{trans('forms.symbol_money') . number_format($d->OCT,2)}}</td>
                                            <td>{{trans('forms.symbol_money') . number_format($d->NOV,2)}}</td>
                                            <td>{{trans('forms.symbol_money') . number_format($d->DEC,2)}}</td>
                                            <td>{{trans('forms.symbol_money') . number_format($d->total,2)}}</td>
                                            <td>{{$d->year}}</td>
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