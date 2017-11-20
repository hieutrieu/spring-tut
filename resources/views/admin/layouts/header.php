@section('header')
    <header class="main-header">
        <a href="{{url('admin/dashboard/index')}}" class="logo">
            <span class="logo-mini">{{config('app.site_name_short')}}</span>
            <span class="logo-lg">{{config('app.site_name')}}</span>
        </a>
        <nav class="navbar navbar-static-top" role="navigation">
            <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
                <span class="sr-only"></span>
            </a>
            <div class="navbar-custom-menu">
                <ul class="nav navbar-nav">
                    <li class="dropdown user user-menu">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                            <img src="{{url('themes/admin/img/avatar_default.png')}}" class="user-image" alt="User Image" />
                            <span class="hidden-xs">{{isset($admin['name'])?$admin['name']:''}} <i class="caret"></i></span>
                        </a>
                        <ul class="dropdown-menu">
                            <!-- User image -->
                            <li class="user-header bg-light-blue">
                                <img src="{{url('themes/admin/img/avatar_default.png')}}" class="img-circle" alt="User Image" />
                                <p>
                                    {{isset($admin['email'])?$admin['email']:''}}
                                    <small>{{date('l jS \of F Y h:i:s A',time())}}</small>
                                </p>
                            </li>
                            <!-- Menu Body -->
                            <!-- Menu Footer-->
                            <li class="user-footer" style="background-color: #222D32;">
                                <div class="pull-right">
                                    <a href="{{url('admin/auth/logout')}}" class="btn btn-warning"><span class="glyphicon glyphicon-off"></span> Logout</a>
                                </div>
                            </li>
                        </ul>
                    </li>
                    <li>
                        <a href="{{url('admin/filescan')}}"><i class="fa fa-gears"></i></a>
                    </li>
                </ul>
            </div>
        </nav>
    </header>
@endsection