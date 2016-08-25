<!doctype html>
<html lang="en" class="no-js">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1, maximum-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>{{ trans('messages.title') }}</title>

    <!-- Font awesome -->
    <link rel="stylesheet" href="css/font-awesome.min.css">
    <!-- Sandstone Bootstrap CSS -->
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <!-- Bootstrap Datatables -->
    <link rel="stylesheet" href="css/dataTables.bootstrap.min.css">
    <!-- Bootstrap social button library -->
    <link rel="stylesheet" href="css/bootstrap-social.css">
    <!-- Bootstrap select -->
    <link rel="stylesheet" href="css/bootstrap-select.css">
    <!-- Bootstrap file input -->
    <link rel="stylesheet" href="css/fileinput.min.css">
    <!-- Awesome Bootstrap checkbox -->
    <link rel="stylesheet" href="css/awesome-bootstrap-checkbox.css">
    <!-- Admin Stye -->
    <link rel="stylesheet" href="css/style.css">

    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->

</head>

<body>

<div class="login-page bk-img" style="background-image: url(img/login-bg.jpg);">
    <div class="form-content">
        <div class="container">
            <div class="row">
                <div class="col-md-6 col-md-offset-3">
                    <h1 class="text-center text-bold text-light mt-4x">{{trans('login.signin')}}</h1>
                    <div class="well row pt-2x pb-3x bk-light">
                        <div class="col-md-8 col-md-offset-2">
                            @if($errors->any())
                                <div class="alert alert-dismissible alert-danger">
                                    <button type="button" class="close" data-dismiss="alert"><i class="fa fa-remove"></i></button>
                                    @foreach($errors->all() as $error)
                                        <strong>{{ $error }}</strong>
                                    @endforeach
                                </div>
                            @endif

                            <form class="mt" role="form" method="POST" action="{{ url('/login') }}">

                                <label for="" class="text-uppercase text-sm">{{trans('login.username')}}</label>
                                <input type="text" id="email" name="email" placeholder="{{trans('login.username')}}" class="form-control mb" required>

                                <label for="" class="text-uppercase text-sm">{{trans('login.password')}}</label>
                                <input type="password" id="password" name="password" placeholder="{{trans('login.password')}}" class="form-control mb" required>

                                <div class="checkbox checkbox-circle checkbox-info">
                                    <input id="checkbox7" type="checkbox" checked>
                                    <label for="checkbox7">
                                        {{trans('login.connected')}}
                                    </label>
                                </div>

                                <button class="btn btn-primary btn-block" type="submit">{{trans('login.login')}}</button>

                                <input type="hidden" name="_token" value="{{ csrf_token() }}">

                            </form>
                        </div>
                    </div>
                    <div class="text-center text-light">
                        <a href="#" class="text-light">{{trans('login.forgot_password')}}</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Loading Scripts -->
<script src="js/jquery.min.js"></script>
<script src="js/bootstrap-select.min.js"></script>
<script src="js/bootstrap.min.js"></script>
<script src="js/jquery.dataTables.min.js"></script>
<script src="js/dataTables.bootstrap.min.js"></script>
<script src="js/Chart.min.js"></script>
<script src="js/fileinput.js"></script>
<script src="js/chartData.js"></script>
<script src="js/main.js"></script>

</body>

</html>