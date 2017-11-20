@layout('admin.layouts.layout')
@section('content')
<div class="box box-primary">
    <div class="box-header with-border">
        <div class="box-title">
            List of Groups
        </div>
        <div class="box-tools pull-right">
            <div class="btn-group-sm">
                <a href="{{url('admin/groups/edit/0')}}" class="btn btn-lg btn-primary "><i class="fa fa-plus"></i> Create Group</a>
            </div>
        </div>
    </div>
    <div class="box-body no-padding">
        <div class="mailbox-controls clearfix">
            <div class="row">
                <div class="col-md-6">
                    <form role="form" class="form-inline" method="GET" action="{{url('admin/groups/')}}">
                        <div class="input-group input-group-sm col-xs-10 pull-left">
                            <input type="text" value="{{$search}}" name="search" class="form-control" placeholder="Enter Name to Search">
                        <span class="input-group-btn">
                          <button class="btn btn-primary" type="submit"><span class="glyphicon glyphicon-search"></span> Search</button>
                        </span>
                        </div>
                    </form>
                </div>
                <div class="col-md-6">
                    {{$pager->createLinks(6)}}
                </div>
            </div>
        </div>
        <div class="table-responsive mailbox-messages">
            <table class="table table-striped table-bordered table-hover" align="center">
                <thead>
                <tr>
                    <th class="text-center small-col">#</th>
                    <th class="text-left">Name</th>
                    <th class="text-left" width="50%">Description</th>
                    <th class="text-center action">Action</th>
                </tr>
                </thead>
                <tbody>
                @foreach($pager->getItems() as $index => $value)
                <tr>
                    <td class="text-center">{{++$index}}</td>
                    <td class="text-left">
                        <a href="{{url('admin/groups/info/'.$value['id'])}}" class="{{$value['id']}}">
                            {{$value['name']}}
                        </a>
                    </td>
                    <td class="text-left">{{$value['description']}}</td>
                    <td class="text-center middle" style="width:200px">
                        <div class="btn-group-xs">
                            <a href="{{url('admin/groups/edit/'.$value['id'])}}" class="btn btn-small btn-sm btn-warning ">Edit | <span class="fa fa-edit"></span></a>
                            <a href="{{url('admin/groups/delete/'.$value['id'])}}" class="btn btn-small btn-sm btn-danger " onclick="return confirm('Do you want to delete this group?');">Delete
                                | <span class="fa fa-trash-o"></span></a>
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