@section('left')
<section class="sidebar">
    <!-- Sidebar user panel -->
    <div class="user-panel">
        <div class="pull-left image">
            <img src="{{url('themes/admin/img/avatar_default.png')}}" class="img-circle" alt="User Image" />
        </div>
        <div class="pull-left info">
            <p>Hi, {{isset($admin['name'])?$admin['name']:''}}</p>
            <a href="#"><i class="fa fa-circle text-success"></i> {{isset($admin['email'])?$admin['email']:''}}</a>
        </div>
    </div>
    {{$menu->renders()}}
</section>
@endsection