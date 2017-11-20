@include('layouts.footer')
@include('layouts.header')
<!DOCTYPE html>
<html dir="ltr" lang="en">
<head>
    <title>{{isset($title)?$title:'Telephone Cost'}}</title>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
    <link rel="icon" type="image/png" href="{{url('images/favicon.png')}}">
    <meta content="" name="description">
    <meta content="" name="keywords">
    <meta name="asset-url" content="//assets.strikingly.com">
    <meta name="mode">
    <link rel="stylesheet" href="{{url('themes/bootstrap/bootstrap.min.css')}}">
    <link rel="stylesheet" href="{{url('themes/cinnamon/css/style.css')}}" type="text/css" />
    @yield('addCss')
    <script src="{{url('themes/js/jquery-2.1.4.min.js')}}" type="text/javascript"></script>
    <script src="{{url('themes/js/bootstrap.min.js')}}" type="text/javascript"></script>
    <script src="{{url('themes/js/nav/jquery.nav.js')}}" type="text/javascript"></script>
    @yield('addJs')
</head>
<body class="">
    @yield('header')
    <div class="wrapper">
        @yield('banner')
        <!-- Main content -->
        <section class="content">
            @yield('content')
        </section>
        @yield('footer')
    </div>
    <script src="{{url('themes/js/app.js')}}" type="text/javascript"></script>
</body>
</html>