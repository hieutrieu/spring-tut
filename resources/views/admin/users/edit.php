@layout('admin.layouts.layout')
@section('content')
<!--{{debug($admin)}}-->
<form action="{{url('admin/users/save')}}" id="adminForm" method="post" xmlns="http://www.w3.org/1999/html">
    <div class="col-xs-12 no-padding">
        <div class="box box-primary">
            <div class="box-header">
                <h3 class="box-title">{{isset($member)?'Edit':'Create'}}</h3>
            </div>
            <div class="box-body">
                <div class="row">
                    <input name="id" type="hidden" value="{{isset($member)?$member->id:0}}">

                    <div class="form-group clearfix">
                        <div class="col-lg-2 col-md-2 col-sm-12 col-xs-12">
                            <label>Name (*)</label>
                        </div>
                        <div class="col-lg-10 col-md-10 col-sm-12 col-xs-12">
                            <input name="name" class="form-control required" placeholder="Name"
                                   value="{{isset($member)?$member->name:''}}">
                        </div>
                    </div>
                    <div class="form-group clearfix">
                        <div class="col-lg-2 col-md-2 col-sm-12 col-xs-12">
                            <label>Phone number (*)</label>
                        </div>
                        <div class="col-lg-10 col-md-10 col-sm-12 col-xs-12">
                            <input type="tel" name="phone_number" class="form-control required"
                                   placeholder="Phone number" value="{{isset($member)?$member->phone_number:''}}">
                        </div>
                    </div>
                    <div class="form-group clearfix">
                        <div class="col-lg-2 col-md-2 col-sm-12 col-xs-12">
                            <label>Email (*)</label>
                        </div>
                        <div class="col-lg-10 col-md-10 col-sm-12 col-xs-12">
                            <input type="email" name="email" class="form-control required" placeholder="email"
                                   value="{{isset($member)?$member->email:''}}">
                        </div>
                    </div>

                    <div class="form-group clearfix">
                        <div class="col-lg-2 col-md-2 col-sm-12 col-xs-12">
                            <label>Address</label>
                        </div>
                        <div class="col-lg-10 col-md-10 col-sm-12 col-xs-12">
                            <input type="text" name="address" class="form-control required" placeholder="Address"
                                   value="{{isset($member)?$member->address:''}}">
                        </div>
                    </div>
                    <div class="form-group clearfix">
                        <div class="col-lg-2 col-md-2 col-sm-12 col-xs-12">
                            <label>Monthly limited cost</label>
                        </div>
                        <div class="col-lg-10 col-md-10 col-sm-12 col-xs-12">
                            <input type="text"  id="monthly_limited_cost" onkeypress="return allowEnterNumberKey(event)" name="monthly_limited_cost" class="form-control" value="{{isset($member)?number_format($member->monthly_limited_cost, 2, '.', ','):''}}">
                        </div>
                    </div>

                    <div class="form-group clearfix">
                        <div class="col-lg-2 col-md-2 col-sm-12 col-xs-12">
                            <label>User name (*)</label>
                        </div>
                        <div class="col-lg-10 col-md-10 col-sm-12 col-xs-12">
                            <input type="text" name="user_name" class="form-control required" placeholder="User Name"
                                   value="{{isset($member)?$member->username:''}}">
                        </div>
                    </div>

                    <div class="form-group clearfix">
                        <div class="col-lg-2 col-md-2 col-sm-12 col-xs-12">
                            <label>Group</label>
                        </div>
                        <div class="col-lg-10 col-md-10 col-sm-12 col-xs-12">
                            <select name="group_id" class="form-control">
                                @foreach($group["items"] as $key=>$value)
                                    @if($member->group_id==$value['id'])
                                        <option selected value="{{$value['id']}}">{{$value['name']}}</option>
                                    @else
                                        <option value="{{$value['id']}}">{{$value['name']}}</option>
                                    @endif
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="form-group clearfix">
                        <div class="col-lg-2 col-md-2 col-sm-12 col-xs-12">
                            <label>Permission</label>
                        </div>
                        <div class="col-lg-10 col-md-10 col-sm-12 col-xs-12">
                            <select name="permission" class="form-control">
                                @foreach($listPermission as $key=>$value)
                                    @if($member->permission==$key)
                                        <option selected value="{{$key}}">{{$value}}</option>
                                    @else
                                        <option value="{{$key}}">{{$value}}</option>
                                    @endif
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>
            </div>
            <div class="box-footer text-right">
                <div class="btn-group-xs">
                    <a href="{{url('admin/users')}}" class="btn btn-small btn-warning "><i
                            class='fa fa-mail-reply'></i> Cancel</a>
                    <button type="submit" class="btn btn-small btn-primary"><i class="fa fa-save"></i> | Save
                    </button>
                </div>
            </div>
        </div>
    </div>
</form>
@endsection
@section('addJs')
<script src="{{url('themes/admin/js/ckfinder/ckfinder.js')}}" type="text/javascript"></script>
<script src="{{url('themes/admin/js/ckeditor/ckeditor.js')}}" type="text/javascript"></script>
@endsection
@section('addJsInline')
<script type="text/javascript">
    $(function(){

        $("#monthly_limited_cost").blur(function(){

            var originValue=$(this).val().replace(/,/g, '');
            if (!isNaN(originValue))
            {
                var formatedValue=converMoney(originValue);
                $(this).val(formatedValue);
            }

        })
    });
    function allowEnterNumberKey(evt) {
        var charCode = (evt.which) ? evt.which : event.keyCode;

        if (charCode == 46 && evt.srcElement.value.split('.').length>1) {
            return false;
        }
        if (charCode != 46 && charCode > 31 && (charCode < 48 || charCode > 57))
            return false;
        return true;
    }

    function converMoney(money) {
        if(money=="")
        {
            return 0;
        }
        var number = parseFloat(money).toFixed(2) + '';
        var x = number.split('.');
        var x1 = x[0];
        var x2 = x.length > 1 ? '.' + x[1] : '';
        var rgx = /(\d+)(\d{3})/;
        while (rgx.test(x1)) {
            x1 = x1.replace(rgx, '$1' + ',' + '$2');
        }
        return x1 + x2;
    };

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
                name: {
                    message: 'The Name is not valid',
                    validators: {
                        notEmpty: {
                            message: 'The Name is required'
                        }
                    }
                },
                phone_number: {
                    message: 'The Phone is not valid',
                    validators: {
                        notEmpty: {
                            message: 'The Phone is required'
                        }
                    }
                },
//                email: {
//                    message: 'The Email is not valid',
//                    validators: {
//                        notEmpty: {
//                            message: 'The Email is required'
//                        }
//                    }
//                },
//                user_name: {
//                    message: 'The User name is not valid',
//                    validators: {
//                        notEmpty: {
//                            message: 'The User name is required'
//                        }
//                    }
//                },
                password: {
                    message: 'The Password is not valid',
                    validators: {
                        notEmpty: {
                            message: 'The Password is required'
                        }
                    }
                }
            }
        });
</script>
@endsection