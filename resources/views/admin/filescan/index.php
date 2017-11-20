@layout('admin.layouts.layout')
@section('content')
<div class="box box-primary">
    <div class="box-header with-border">
        <div class="box-title">
            List of file scaned
        </div>
        <div class="box-tools pull-right">

        </div>
    </div>
    <div class="box-body no-padding">
        <div class="mailbox-controls clearfix">
            <div class="row">
                <div class="col-md-6">
                    <form role="form" class="form-inline" method="GET" action="{{url('admin/filescan/')}}">
                        <div class="input-group input-group-sm col-xs-10 pull-left">
                            <input type="text" value="{{$search}}" name="search" class="form-control" placeholder="Enter Name or Status">
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
                    <th class="text-center small-col" width="40px">#</th>
                    <th class="text-left">File Name</th>
                    <th class="text-center">Status</th>
                    <th class="text-center">Created at</th>
                </tr>
                </thead>
                <tbody>
                @foreach($pager->getItems() as $index => $value)
                <tr>
                    <td class="text-center">{{++$index}}</td>
                    <td class="text-left">
                        {{$value['name']}}
                    </td>
                    <td class="text-center {{$value['status'] == 'failed' ? 'bg-danger' : ''}}">{{$value['status']}}</td>
                    <td class="text-center">{{$value['created_at']}}</td>
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