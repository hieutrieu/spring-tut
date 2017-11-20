@layout('admin.layouts.layout')
@section('content')
<div class="box box-primary">
    <div class="box-body no-padding">
        <div class="mailbox-controls clearfix">
            <div class="info-box bg-green">
                <span class="info-box-icon"><i class="fa fa-users"></i></span>

                <div class="info-box-content">
                    <span class="info-box-text">{{$group->name}}</span>
                    <small>{{$group->description}}</small>
                    <div class="progress">
                        <div class="progress-bar" style="width: 100%"></div>
                    </div>
                    <span class="progress-description">
                        Total Users: {{$userTotal}}
                    </span>
                </div>
                <!-- /.info-box-content -->
            </div>
        </div>
    </div>

</div>

<div class="nav-tabs-custom">
    <ul class="nav nav-tabs">
        <li class="{{$active_tab==1?'':'active'}}"><a href="#users_cost" data-toggle="tab">Cost</a></li>
        <li class="{{$active_tab==1?'active':''}}"><a href="#users_list" data-toggle="tab">Users</a></li>
    </ul>
    <div class="tab-content no-padding">
        <div class="tab-pane {{$active_tab==1?'':'active'}}" id="users_cost">
            <div class="mailbox-controls clearfix">
                <div class="row">
                    <div class="col-md-6">
                        <form role="form" class="form-inline" method="GET"
                              action="{{url('admin/groups/info/'.$group->id)}}">
                            <div class="input-group input-group-sm col-xs-10 pull-left">
                                <input type="text" value="{{$search!=''?$search:''}}" name="search" class="form-control"
                                       placeholder="Enter Name to Search">
                                <span class="input-group-btn">
                                    <button class="btn btn-primary" type="submit"><span class="glyphicon glyphicon-search"></span> Search</button>
                                    <a class="btn btn-warning" href="{{url('admin/groups/report/'.$group->id.$link_report)}}"><span class="fa fa-download"></span> Export</a>
                                </span>

                            </div>
                        </form>
                    </div>

                </div>
            </div>
            <div class="table-responsive mailbox-messages">
                <table class="table table-striped table-bordered table-hover" align="center">
                    <thead>
                    <tr>
                        <th class="text-center small-col" width="40px">#</th>
                        <th class="text-left" width="30%">From</th>
                        <th class="text-right">Duration (s)</th>
                        <th class="text-right">Cost (VND)</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($pagerHistory->getItems() as $index => $value)
                    <tr>
                        <td class="text-center">{{++$index}}</td>
                        <td class="text-left"><a href="{{url('admin/users/info/'.$value['user_id'])}}"
                                                 class="{{$value['user_id']}}">{{$userNames[$value['user_id']]}}</a></br>
                            <label style="color: #CDCDCD;">{{$userPhone[$value['user_id']]}}</label></td>
                        <td class="text-right">{{App\Libraries\Helper::formatCurrency($value['total_duration'],0,0)}}</td>
                        <td class="text-right">{{App\Libraries\Helper::formatCurrency($value['total_cost'],2,0)}}</td>
                    </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
            <div class="box-footer">
                {{$pagerHistory->createLinks(6)}}
            </div>
        </div>
        <div class="tab-pane {{$active_tab==1?'active':''}}" id="users_list">
            <div class="table-responsive mailbox-messages">
                <table class="table table-striped table-bordered table-hover" align="center">
                    <thead>
                    <tr>
                        <th class="text-center small-col" width="40px">#</th>
                        <th class="text-left" width="30%">Name</th>
                        <th class="text-left">Phone number</th>
                        <th class="text-center action" style="width:200px">Action</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($pagerUser->getItems() as $index => $value)
                    <tr>
                        <td class="text-center">{{++$index}}</td>
                        <td class="text-left">{{$value['name']}}</td>
                        <td class="text-left">{{$value['phone_number']}}</td>
                        <td class="text-center middle">
                            <div class="btn-group-xs">
                                <a href="{{url('admin/users/edit/'.$value['id'])}}"
                                   class="btn btn-small btn-sm btn-warning">Edit | <span
                                        class="fa fa-edit"></span></a>
                                <a href="{{url('admin/users/delete/'.$value['id'])}}"
                                   class="btn btn-small btn-sm btn-danger"
                                   onclick="return confirm('Do you want to delete this user?');">Delete | <span
                                        class="fa fa-trash-o"></span></a>
                            </div>
                        </td>
                    </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
            <div class="box-footer">
                {{$pagerUser->createLinks(6)}}
            </div>
        </div>
    </div>
</div>
@endsection

@section('addCss')
<link rel="stylesheet" href="{{url('themes/admin/js/plugins/date_range_picker/daterangepicker.css')}}" type="text/css"/>
@endsection
@section('addJs')
<script src="{{url('themes/admin/js/plugins/date_range_picker/moment.min.js')}}" type="text/javascript"></script>
<script src="{{url('themes/admin/js/plugins/date_range_picker/daterangepicker.js')}}" type="text/javascript"></script>
@endsection
@section('addJsInline')
<script>
    $('input[name="search"]').daterangepicker({
        locale: {
            format: 'YYYY/MM/DD'
        }
    });
</script>
@endsection