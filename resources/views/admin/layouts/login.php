<!DOCTYPE html>
<html lang="en">
<head>
    <title>{{isset($title)?$title:'Cinnamon'}}</title>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
    <link rel="shortcut icon" href="{{url('favicon.ico')}}" type="image/x-icon">
    <link rel="stylesheet" href="{{url('themes/bootstrap/css/bootstrap.min.css')}}">
    <link rel="stylesheet" href="{{url('themes/admin/fonts/font-awesome.min.css')}}" type="text/css" />
    <link rel="stylesheet" href="{{url('themes/admin/fonts/ionicons.min.css')}}" type="text/css" />
    <link rel="stylesheet" href="{{url('themes/admin/css/AdminLTE.css')}}" type="text/css" />
    <link rel="stylesheet" href="{{url('themes/admin/css/skins/_all-skins.min.css')}}" type="text/css" />
    <link rel="stylesheet" href="{{url('themes/admin/js/plugins/jquery.alert/alertify.core.css')}}" type="text/css" />
    @yield('addCss')
    <script src="{{url('themes/js/jquery-2.1.4.min.js')}}" type="text/javascript"></script>
    <script src="{{url('themes/bootstrap/js/bootstrap.min.js')}}" type="text/javascript"></script>
    <script src="{{url('themes/admin/js/plugins/slimScroll/jquery.slimscroll.min.js')}}" type="text/javascript"></script>
    <script src="{{url('themes/admin/js/plugins/jquery.alert/alertify.min.js')}}" type="text/javascript"></script>
    <script src="{{url('themes/admin/js/plugins/bootstrapvalidator/js/bootstrapValidator.js')}}" type="text/javascript"></script>
</head>
<body class="hold-transition login-page">
    @yield('content')
    <div class="login-box">{{$flash->display()}}</div>
</body>
</html>