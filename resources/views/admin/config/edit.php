@layout('admin.layouts.layout')
@section('content')
<form action="{{url('admin/config/save')}}" id="adminForm" method="post" xmlns="http://www.w3.org/1999/html">
    <div class="col-xs-12 no-padding">
        <div class="box box-primary">
            <div class="box-body">
                <fieldset>
                    <legend>MOBILE PHONE</legend>
                    <div class="form-group clearfix">
                        <div class="col-lg-2 col-md-2 col-sm-12 col-xs-12">
                            <label>Block 6s</label>
                        </div>
                        <div class="col-lg-10 col-md-10 col-sm-12 col-xs-12">
                            <div class="input-group input-group-sm">
                                <input name="data[mobilephone][6s]" class="form-control required" placeholder="" value="{{isset($data['mobilephone'])?$data['mobilephone']['6s']:''}}">
                            </div>
                        </div>
                    </div>
                    <div class="form-group clearfix">
                        <div class="col-lg-2 col-md-2 col-sm-12 col-xs-12">
                            <label>Block 1s</label>
                        </div>
                        <div class="col-lg-10 col-md-10 col-sm-12 col-xs-12">
                            <div class="input-group input-group-sm">
                                <input name="data[mobilephone][1s]" class="form-control required" placeholder="" value="{{isset($data['mobilephone'])?$data['mobilephone']['1s']:''}}">
                            </div>
                        </div>
                    </div>
                </fieldset>
                <fieldset>
                    <legend>TELEPHONE</legend>
                    <div class="form-group clearfix">
                        <div class="col-lg-2 col-md-2 col-sm-12 col-xs-12">
                            <label>Block 6s</label>
                        </div>
                        <div class="col-lg-10 col-md-10 col-sm-12 col-xs-12">
                            <div class="input-group input-group-sm">
                                <input name="data[telephone][6s]" class="form-control required" placeholder="" value="{{isset($data['telephone'])?$data['telephone']['6s']:''}}">
                            </div>
                        </div>
                    </div>
                    <div class="form-group clearfix">
                        <div class="col-lg-2 col-md-2 col-sm-12 col-xs-12">
                            <label>Block 1s</label>
                        </div>
                        <div class="col-lg-10 col-md-10 col-sm-12 col-xs-12">
                            <div class="input-group input-group-sm">
                                <input name="data[telephone][1s]" class="form-control required" placeholder="" value="{{isset($data['telephone'])?$data['telephone']['1s']:''}}">
                            </div>
                        </div>
                    </div>
                </fieldset>
            </div>
            <div class="box-footer text-right">
                <div class="btn-group-xs">
                    <button type="submit" class="btn btn-small btn-flat btn-primary"><i class="fa fa-save"></i> | Save</button>
                </div>
            </div>
        </div>
    </div>
</form>
@endsection
@section('addJsInline')
<script type="text/javascript">
    $('#adminForm')
        .bootstrapValidator({
            message: 'This value is not valid',
            group: '.form-group',
            feedbackIcons: {
                valid: '',
                invalid: '',
                validating: ''
            },
            fields: {
                'data[mobilephone][6s]': {
                    validators: {
                        notEmpty: {
                            message: 'The block is required'
                        },
                        numeric: {
                            message: 'The value is not a number',
                            // The default separators
                            thousandsSeparator: '',
                            decimalSeparator: '.'
                        }
                    }
                },
                'data[mobilephone][1s]': {
                    validators: {
                        notEmpty: {
                            message: 'The block is required'
                        },
                        numeric: {
                            message: 'The value is not a number',
                            // The default separators
                            thousandsSeparator: '',
                            decimalSeparator: '.'
                        }
                    }
                },
                'data[telephone][6s]': {
                    validators: {
                        notEmpty: {
                            message: 'The block is required'
                        },
                        numeric: {
                            message: 'The value is not a number',
                            // The default separators
                            thousandsSeparator: '',
                            decimalSeparator: '.'
                        }
                    }
                },
                'data[telephone][1s]': {
                    validators: {
                        notEmpty: {
                            message: 'The block is required'
                        },
                        numeric: {
                            message: 'The value is not a number',
                            // The default separators
                            thousandsSeparator: '',
                            decimalSeparator: '.'
                        }
                    }
                }
            }
        });
</script>
@endsection