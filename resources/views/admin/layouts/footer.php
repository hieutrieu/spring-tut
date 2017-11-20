@section('footer')
    @yield('addJs')
    @yield('addJsInline')
    <script src="{{url('themes/admin/js/app.js')}}" type="text/javascript"></script>
@endsection