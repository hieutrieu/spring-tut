@section('header')
    <header id="nav_top" class="navbar-fixed-top">
        <div class="container">
            <div id="nav_top_left" class="pull-left">
                <a href="{{url('')}}" class="logo"><img src="{{url('images/logo.png')}}" /></a>
            </div>
            <div class="navbar-toggle collapsed" data-toggle="collapse" data-target="#global-nav">
                <span class="sr-only">&nbsp;</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </div>
            <nav id="nav_top_right" class="navbar navbar-full pull-right" role="navigation">
                <div class="collapse navbar-collapse" id="global-nav">
                    <div class="navbar-right">
                        <ul class="nav navbar-nav" id="top_menu">
                            <li class="{{$uriVars[0]=='about'?'current':''}}">
                                <a href="{{url('about')}}">ABOUT</a>
                            </li>
                            <li class="">
                                <a href="{{url('#latest_project')}}">PRODUCTS</a>
                            </li>
                            <li class="{{$uriVars[0]=='recruitment'?'current':''}}">
                                <a href="{{url('recruitment')}}">RECRUIT</a>
                            </li>
                            <li class="">
                                <a href="{{url('#open_space')}}">OPEN SPACE</a>
                            </li>
                            <li class="{{$uriVars[0]=='blog'?'current':''}}">
                                <a href="{{url('blog')}}">BLOG</a>
                            </li>
                            <li class="">
                                <a href="{{url('#contact')}}">CONTACT</a>
                            </li>
                        </ul>
                    </div>
                </div>
            </nav>
        </div>
    </header>
@endsection