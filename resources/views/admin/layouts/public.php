@include('admin.layouts.footer')
@include('admin.layouts.header')
@include('admin.layouts.sidebar_left')
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
<body class="skin-blue sidebar-mini">
<div class="wrapper">
    @yield('header')
    <div class="wrapper row-offcanvas row-offcanvas-left">
        <aside class="content-wrapper">
            <section class="content-header">
                <h1>
                    {{isset($title)?$title:''}}
                    <small></small>
                </h1>
                @if(isset($bc))
                <ol class="breadcrumb">
                    @foreach($bc as $breadcrumb)
                    <li class="active"><i class="fa"></i> <a href="{{ $breadcrumb['link'] }}">{{ $breadcrumb['text'] }}</a></li>
                    @endforeach
                </ol>
                @endif
            </section>
            <!-- Main content -->
            <section class="content">
                @yield('content')
            </section>
        </aside>
    </div>
</div>
@yield('footer')
</body>
</html>