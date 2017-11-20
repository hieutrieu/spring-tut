
<div class="box box-primary">
    <div class="box-header clearfix">
        <i class="ion ion-clipboard"></i>
        <div class="box-tools pull-right">
            <div class="btn-group btn-group-sm">
                <button type="button" data-number="15" class="btn btn-primary" onclick="return chartRender(this, 15);">15D</button>
                <button type="button" data-number="30" class="btn btn-default" onclick="return chartRender(this, 30);">30D</button>
                <button type="button" data-number="90" class="btn btn-default" onclick="return chartRender(this, 90);">90D</button>
                <button type="button" data-number="180" class="btn btn-default" onclick="return chartRender(this, 180);">180D</button>
                <button type="button" data-number="365" class="btn btn-default" onclick="return chartRender(this, 360);">365D</button>
            </div>
        </div>
    </div><!-- /.box-header -->
    <div class="box-body">
        <div class="chart" id="chart" style="height: 400px;"></div>
    </div><!-- /.box-body -->
    <div class="box-footer clearfix no-border">

    </div>
</div>
@endsection
@section('addJsInline')
<script type="text/javascript">
    $(function() {
        "use strict";
        //BAR CHART
        var bar = new Morris.Bar({
            element: 'chart',
            resize: true,
            data: <?php echo json_encode($users) ?>,
            //barColors: ['#00a65a', '#f56954'],
            xkey: 'days',
            ykeys: ['total_newuser', 'total_comeback'],
            labels: ['DAU', 'Come back'],
            hideHover: 'auto'
        });
    });
    chartRender(null,15);
    function chartRender(myself, duration) {
        var url = baseurl  + '/admin/dashboard/statisticuser';
        var param = {'duration':duration};
        $.ajax({
            url: url,
            type: 'POST',
            cache: false,
            dataType:'json',
            data: param,
            success: function(data) {
                var bar = new Morris.Line({
                    element: 'chart',
                    resize: true,
                    data: data.data,
                    //barColors: ['#00a65a', '#f56954'],
                    xkey: data.xkey,
                    ykeys: data.ykeys,
                    labels: data.labels,
                    hideHover: 'auto'
                });
            },
            error: function(xhr, err) {

            }
        });
    };
</script>
@endsection
