@layout('admin.layouts.layout')
@section('content')
<div class="box box-primary">
    <div class="box-header with-border">
        <div class="box-title">
            List of Groups
        </div>
        <div class="box-tools pull-right">
            <div class="btn-group-xs">
                <a href="{{url('admin/groups/edit/0')}}" class="btn btn-small btn-primary btn-flat"><i class="fa fa-plus"></i> Create Group</a>
            </div>
        </div>
    </div>
    <div class="box-body no-padding">
        <div class="mailbox-controls clearfix">
            <div class="input-group input-group-sm col-xs-4 pull-left">
                <input type="text" class="form-control" placeholder="Enter name">
                <span class="input-group-btn">
                  <button class="btn btn-default btn-flat" type="button">Search</button>
                </span>
            </div>
            {{$pager->createLinks(6)}}
        </div>
        <div class="table-responsive mailbox-messages">
            <table class="table table-striped table-bordered table-hover" align="center">
                <thead>
                <tr>
                    <th class="text-center small-col">#</th>
                    <th class="text-left" width="15%">Date</th>
                    <th class="text-left" width="15%">Name</th>
                    <th class="text-left" width="15%">To</th>
                    <th class="text-left" width="10%">Duration</th>
                    <th class="text-left">Cost</th>
                    <th class="text-center action">Action</th>
                </tr>
                </thead>
                <tbody>
                @foreach($pager->getItems() as $index => $value)
                <tr>
                    <td class="text-center">{{++$index}}</td>
                    <td class="text-left">{{$value['called_at']}}</td>
                    <td class="text-left">
                        <a href="{{url('admin/groups/info/'.$value['user_id'])}}">
                            <div class="text-bold">{{$value['user_id']}}</div>
                            <small>{{$value['phone_number_from']}}</small>
                        </a>
                    </td>
                    <td class="text-left">{{$value['phone_number_to']}}</td>
                    <td class="text-left">{{$value['duration']}}</td>
                    <td class="text-left">{{$value['cost']}}</td>
                    <td class="text-center middle" style="width:200px">
                        <div class="btn-group-xs">
                            <a href="{{url('admin/groups/edit/'.$value['id'])}}" class="btn btn-small btn-sm btn-warning btn-flat">Edit | <span class="fa fa-edit"></span></a>
                            <a href="{{url('admin/groups/delete/'.$value['id'])}}" class="btn btn-small btn-sm btn-danger btn-flat" onclick="return confirm('Do you want to delete this group?');">Delete | <span class="fa fa-trash-o"></span></a>
                        </div>
                    </td>
                </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
    <div class="box-footer">
        {{$pager->createLinks(6)}}
    </div>
</div>
@endsection