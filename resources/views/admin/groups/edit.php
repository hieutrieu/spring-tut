@layout('admin.layouts.layout')
@section('content')
<form action="{{url('admin/groups/save')}}" id="adminForm" method="post" xmlns="http://www.w3.org/1999/html">
        <div class="col-xs-12 no-padding">
            <div class="box box-primary">
                <div class="box-header">
                    <h3 class="box-title">{{isset($member)?'Edit':'Create'}}</h3>
                </div>
                <div class="box-body">
                    <input name="id" type="hidden" value="{{isset($member)?$member->id:0}}">
                    <div class="form-group clearfix">
                        <div class="col-lg-2 col-md-2 col-sm-12 col-xs-12">
                            <label>Name (*)</label>
                        </div>
                        <div class="col-lg-10 col-md-10 col-sm-12 col-xs-12">
                            <input name="name" class="form-control required" placeholder="Name" value="{{isset($member)?$member->name:''}}">
                        </div>
                    </div>
                    <div class="form-group clearfix">
                        <div class="col-lg-2 col-md-2 col-sm-12 col-xs-12">
                            <label>Description</label>
                        </div>
                        <div class="col-lg-10 col-md-10 col-sm-12 col-xs-12">
                            <textarea name="description" class="form-control">{{isset($member)?$member->description:''}}</textarea>
                        </div>
                    </div>
                    <div class="form-group clearfix">
                        <div class="col-lg-2 col-md-2 col-sm-12 col-xs-12">
                            <label>Tính cước</label>
                        </div>
                        <div class="col-lg-8 col-md-8 col-sm-12 col-xs-12">
                            <table class="table table-bordered">
                                <tbody>
                                <tr>
                                    <td colspan="2"></td>
                                    <td  class="text-bold">Block 6s</td>
                                    <td class="text-bold">+ 1s</td>
                                    <td class="text-bold">1 min</td>
                                </tr>
                                <tr>
                                    <td class="text-bold" style="vertical-align: middle;width: 20%" rowspan="2">Cố định liên tỉnh</td>
                                    <td style="width: 20%;">Liên tỉnh nội mạng</td>
                                    <td><input name="block_in" class=" form-control required col-md-3" type="number" value="{{isset($member)?$member->block_in:''}}"></td>
                                    <td><input name="block_out" class=" form-control required col-md-3" type="number" value="{{isset($member)?$member->block_out:''}}"></td>
                                    <td><input name="block_telephone" class=" form-control required col-md-3" type="number" value="{{isset($member)?$member->block_telephone:''}}"></td>

                                </tr>
                                <tr>
                                    <td>Liên tỉnh khác mạng</td>
                                    <td><input name="second_in" class=" form-control required col-md-3" type="number" value="{{isset($member)?$member->second_in:''}}" ></td>
                                    <td><input name="second_out" class=" form-control required col-md-3" type="number" value="{{isset($member)?$member->second_out:''}}"></td>
                                    <td><input name="second_telephone" class=" form-control required col-md-3" type="number" value="{{isset($member)?$member->second_telephone:''}}"></td>

                                </tr>

                                <tr>
                                    <td class="text-bold">Di động</td>
                                    <td>Di động</td>
                                    <td><input name="minute_in" class=" form-control required col-md-3" type="number" step="any" value="{{isset($member)?$member->minute_in:''}}"  ></td>
                                    <td><input name="minute_out" class=" form-control required col-md-3" type="number" value="{{isset($member)?$member->minute_out:''}}" ></td>
                                    <td><input name="minute_telephone" class=" form-control required col-md-3" type="number" value="{{isset($member)?$member->minute_telephone:''}}" ></td>

                                </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="box-footer text-right">
                    <div class="btn-group-xs">
                        <a href="{{url('admin/groups')}}" class="btn btn-small btn-warning "><i class='fa fa-mail-reply'></i> Cancel</a>
                        <button type="submit" class="btn btn-small  btn-primary"><i class="fa fa-save"></i> | Save</button>
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
                name: {
                    message: 'The Name is not valid',
                    validators: {
                        notEmpty: {
                            message: 'The Name is required'
                        }
                    }
                },
                time: {
                    message: 'The time is not valid',
                    validators: {
                        notEmpty: {
                            message: 'The time is required'
                        }
                    }
                },
            }
        });


</script>
@endsection