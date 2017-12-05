@layout('admin.layouts.layout')
@section('content')
<!--{{debug($admin)}}-->
<form action="{{url('admin/users/admin/save')}}" id="adminForm" method="post" xmlns="http://www.w3.org/1999/html">
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
                            <label>User name (*)</label>
                        </div>
                        <div class="col-lg-10 col-md-10 col-sm-12 col-xs-12">
                            <input type="text" name="user_name" class="form-control required" placeholder="User Name"
                                   value="{{isset($member)?$member->username:''}}">
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
                            <label>Password (*)</label>
                        </div>
                        <div class="col-lg-10 col-md-10 col-sm-12 col-xs-12">
                            <input type="password" name="password" class="form-control required" placeholder="password"
                                   value="">
                        </div>
                    </div>
                    <div class="form-group clearfix">
                        <div class="col-lg-2 col-md-2 col-sm-12 col-xs-12">
                            <label>Phone number</label>
                        </div>
                        <div class="col-lg-10 col-md-10 col-sm-12 col-xs-12">
                            <input type="tel" name="phone_number" class="form-control required"
                                   placeholder="Phone number" value="{{isset($member)?$member->phone_number:''}}">
                        </div>
                    </div>
                </div>
            </div>
            <div class="box-footer text-right">
                <div class="btn-group-xs">
                    <a href="{{url('admin/users/admin')}}" class="btn btn-small btn-warning "><i
                            class='fa fa-mail-reply'></i> Cancel</a>
                    <button type="submit" class="btn btn-small btn-primary"><i class="fa fa-save"></i> | Save
                    </button>
                </div>
            </div>
            <input type="hidden" name="permission" value="admin">
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
                name: {
                    message: 'The Name is not valid',
                    validators: {
                        notEmpty: {
                            message: 'The Name is required'
                        }
                    }
                },
//                phone_number: {
//                    message: 'The Phone is not valid',
//                    validators: {
//                        notEmpty: {
//                            message: 'The Phone is required'
//                        }
//                    }
//                },
                email: {
                    message: 'The Email is not valid',
                    validators: {
                        notEmpty: {
                            message: 'The Email is required'
                        }
                    }
                },
                user_name: {
                    message: 'The User name is not valid',
                    validators: {
                        notEmpty: {
                            message: 'The User name is required'
                        }
                    }
                },
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