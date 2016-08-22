<!doctype html>
<html lang="en" class="no-js">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1, maximum-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <meta name="theme-color" content="#3e454c">

    <title>{{trans('messages.title')}}</title>

    <!-- Font awesome -->
    <link rel="stylesheet" href="{{URL::asset('css/font-awesome.min.css')}}">
    <!-- Sandstone Bootstrap CSS -->
    <link rel="stylesheet" href="{{URL::asset('css/bootstrap.min.css')}}">
    <!-- Bootstrap Datatables -->
    <link rel="stylesheet" href="{{URL::asset('css/dataTables.bootstrap.min.css')}}">
    <!-- Bootstrap social button library -->
    <link rel="stylesheet" href="{{URL::asset('css/bootstrap-social.css')}}">
    <!-- Bootstrap select -->
    <link rel="stylesheet" href="{{URL::asset('css/bootstrap-select.css')}}">
    <!-- Bootstrap file input -->
    <link rel="stylesheet" href="{{URL::asset('css/fileinput.min.css')}}">
    <!-- Awesome Bootstrap checkbox -->
    <link rel="stylesheet" href="{{URL::asset('css/awesome-bootstrap-checkbox.css')}}">
    <!-- Admin Stye -->
    <link rel="stylesheet" href="{{URL::asset('css/style.css')}}">

    <!-- new fields html5 firefox-->
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/webshim/1.15.10/dev/polyfiller.js"></script>
    <script>
        webshims.setOptions('forms-ext', {types: 'date'});
        webshims.polyfill('forms forms-ext');
        $.webshims.formcfg = {
            en: {
                dFormat: '-',
                dateSigns: '-',
                patterns: {
                    d: "dd-mm-yy"
                }
            }
        };
    </script>

    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->

</head>

<body>
<div class="brand clearfix">
    <a href="index.html" class="logo"><img src="img/logo.jpg" class="img-responsive" alt=""></a>
    <span class="menu-btn"><i class="fa fa-bars"></i></span>
    <ul class="ts-profile-nav">
        <li><a href="#">Help</a></li>
        <li><a href="#">Settings</a></li>
        <li class="ts-account">
            <a href="#"><img src="img/ts-avatar.jpg" class="ts-avatar hidden-side" alt="">{{ Auth::user()->name }}<i class="fa fa-angle-down hidden-side"></i></a>
            <ul>
                <li><a href="{{ url('/account') }}">{{ trans('messages.account') }}</a></li>
                <li><a href="#">{{ trans('messages.edit_account') }}</a></li>
                <li><a href="{{ url('/logout') }}">{{ trans('messages.logout') }}</a></li>
            </ul>
        </li>
    </ul>
</div>

<div class="ts-main-content">
    <nav class="ts-sidebar">
        <ul class="ts-sidebar-menu">
            <li class="ts-label">{{ trans('messages.main') }}</li>
            <li><a href="{{ url('/dashboard') }}"><i class="fa fa-dashboard"></i> {{ trans('messages.dashboard') }}</a></li>
            <li><a href="#"><i class="fa fa-users"></i> {{ trans('menu.families') }}</a>
                <ul>
                    <li><a href="{{url('/families')}}"><i class="fa fa-users"></i>{{ trans('menu.add_family') }}</a></li>
                    <li><a href="{{url('/members')}}"><i class="fa fa-user-plus"></i>{{ trans('menu.add_member') }}</a></li>
                </ul>
            </li>
            <li><a href="#"><i class="fa fa-envelope"></i> {{ trans('menu.tithes') }}</a>
                <ul>
                    <li><a href="{{url('/tithes')}}"><i class="fa fa-plus"></i>{{ trans('menu.add_tithe') }}</a></li>
                    <li><a href="{{url('/types')}}"><i class="fa fa-book"></i>{{ trans('menu.add_type_tithe') }}</a></li>
                </ul>
            </li>
            <li><a href="#"><i class="fa fa-money"></i> {{ trans('menu.expensives') }}</a>
                <ul>
                    <li><a href="#"><i class="fa fa-bank"></i>{{ trans('menu.add_account') }}</a></li>
                    <li><a href="#"><i class="fa fa-bars"></i>{{ trans('menu.add_category') }}</a></li>
                    <li><a href="#"><i class="fa fa-calculator"></i>{{ trans('menu.expensive') }}</a></li>
                </ul>
            </li>
            <li><a href="#"><i class="fa fa-pie-chart"></i> {{ trans('menu.charts') }}</a>
                <ul>
                    <li><a href="#"><i class="fa fa-envelope"></i>{{ trans('menu.tithes') }}</a></li>
                    <li><a href="#"><i class="fa fa-users"></i>{{ trans('menu.families') }}</a></li>
                    <li><a href="#"><i class="fa fa-book"></i>{{ trans('menu.expensive') }}</a></li>
                </ul>
            </li>
            <li><a href="#"><i class="fa fa-cog"></i> {{ trans('menu.administration') }}</a>
                <ul>
                    <li><a href="#"><i class="fa fa-child"></i> {{ trans('menu.users') }}</a></li>
                </ul>
            </li>
        </ul>
    </nav>