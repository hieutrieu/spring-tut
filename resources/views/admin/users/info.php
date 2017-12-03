@layout('admin.layouts.layout')
@section('content')
<div class="box box-primary">
    <div class="box-body no-padding">
        <div class="mailbox-controls clearfix">
            <div class="info-box bg-aqua">
                <div class="pull-left">
                    <span class="info-box-icon"><i class="fa fa-user"></i></span>
                </div>
                <div class="pull-left">
                    <div class="col-xs-6" style="margin-top: 10px">
                        <div class="col-xs-12">
                            <label>Name: </label> {{$user->name}}
                        </div>
                        <div class="col-xs-12">
                            <label>Phone: </label> {{$user->phone_number}}
                        </div>
                        <div class="col-xs-12">
                            <label>Email: </label> {{$user->email}}
                        </div>
                    </div>
                    <div class="col-xs-6" style="margin-top: 10px">
                        <div class="col-xs-12">
                            <label>Current Cost: </label> {{App\Libraries\Helper::formatCurrency($user->monthly_used_cost)}}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="box box-primary">
    <div class="box-body">
        <div class="mailbox-controls clearfix">
            <form method="GET" action="{{url('admin/users/info/'.$id)}}"
            <div class="input-group input-group-sm col-xs-4 pull-left">
                <input type="text" name="search" class="form-control" placeholder="Enter name" value="{{$search!=''?$search:''}}">

                <div class="input-group-btn">
                    <button class="btn btn-primary btn-flat" type="submit"><span class="glyphicon glyphicon-search"></span> Search</button>
                    <a class="btn btn-warning" href="{{url('admin/users/report/'.$id.$link_report)}}"><span class="fa fa-download"></span> Export</a>
                </div>
            </div>
            </form>
        </div>
        <div class="table-responsive mailbox-messages">
            <table class="table table-striped table-bordered table-hover" align="center">
                <thead>
                <tr>
                    <th class="text-center small-col" width="40px">#</th>
                    <th class="text-left" width="30%">Date</th>
                    <th class="text-left">To</th>
                    <th class="text-right">Duration (s)</th>
                    <th class="text-right">Cost (VND)</th>
                </tr>
                </thead>
                <tbody>
                @foreach($pager->getItems() as $index => $value)
                <tr>
                    <td class="text-center">{{++$index}}</td>
                    <td class="text-left">{{$value['called_at']}}</td>
                    <td class="text-left">{{$value['to_phone_number']}}</td>
                    <td class="text-right">{{$value['duration']}}</td>
                    <td class="text-right">{{App\Libraries\Helper::formatCurrency($value['cost'],2,0)}}</td>
                </tr>
                @endforeach
                </tbody>
                <tfoot>
                <tr>
                    <th class="text-right" colspan="3">Total</th>
                    <th class="text-right">{{$total['total_duration']}}</th>
                    <th class="text-right">{{App\Libraries\Helper::formatCurrency($total['total_cost'],2,0)}}</th>
                </tr>
                </tfoot>
            </table>
        </div>
        <div class="box-footer">
            {{$pager->createLinks(6)}}
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
    search_date = '{{$search}}';
    if (search_date == '') {
        $('input[name="search"]').daterangepicker({
            locale: {
                format: 'YYYY/MM/DD'
            },
            startDate: moment().subtract(1, 'month'),
            maxDate: new Date()
        });
    } else {
        $('input[name="search"]').daterangepicker({
            locale: {
                format: 'YYYY/MM/DD'
            },
            maxDate: new Date()
        });
    }
</script>
@endsection