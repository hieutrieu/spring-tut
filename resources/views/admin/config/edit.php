@layout('admin.layouts.layout')
@section('content')
<form action="{{url('admin/config/save')}}" id="adminForm" method="post" xmlns="http://www.w3.org/1999/html">
    <div class="box box-primary">
        <div class="box-body">
            <fieldset>
                <legend>NỘI BỘ</legend>
                <div class="form-group clearfix">
                    <div class="col-lg-4 col-md-4">
                        <label>Chiều dài tối đa của số gọi tới</label>
                    </div>
                    <div class="col-lg-8 col-md-8">
                        <input name="data[phone][local][max_length]" class="form-control" placeholder="" value="{{isset($data['phone'])?$data['phone']['local']['max_length']:6}}">
                    </div>
                </div>
            </fieldset>
        </div>
    </div>
    <div class="box box-primary">
        <div class="box-body">
            <fieldset>
                <div class="col-lg-6">
                    <legend class="">DI ĐỘNG - Nội mạng</legend>
                    <div class="form-group clearfix">
                        <div class="col-lg-4 col-md-4 col-sm-6 col-xs-6">
                            <label>Block 6s</label>
                        </div>
                        <div class="col-lg-8 col-md-8 col-sm-6 col-xs-6">
                            <input name="data[mobilephone][nm][6s]" class="form-control required" placeholder="" value="{{isset($data['mobilephone'])?$data['mobilephone']['nm']['6s']:0}}">
                        </div>
                    </div>
                    <div class="form-group clearfix">
                        <div class="col-lg-4 col-md-4 col-sm-6 col-xs-6">
                            <label>Block 1s</label>
                        </div>
                        <div class="col-lg-8 col-md-8 col-sm-6 col-xs-6">
                            <input name="data[mobilephone][nm][1s]" class="form-control required" placeholder="" value="{{isset($data['mobilephone'])?$data['mobilephone']['nm']['1s']:0}}">
                        </div>
                    </div>
                    <div class="form-group clearfix">
                        <div class="col-lg-4 col-md-4 col-sm-6 col-xs-6">
                            <label>Block 1 phut</label>
                        </div>
                        <div class="col-lg-8 col-md-8 col-sm-6 col-xs-6">
                            <input name="data[mobilephone][nm][1p]" class="form-control required" placeholder="" value="{{isset($data['mobilephone'])?$data['mobilephone']['nm']['1p']:0}}">
                        </div>
                    </div>
                </div>
                <div class="col-lg-6">
                    <legend class="">Khác mạng</legend>
                    <div class="form-group clearfix">
                        <div class="col-lg-4 col-md-4 col-sm-6 col-xs-6">
                            <label>Block 6s</label>
                        </div>
                        <div class="col-lg-8 col-md-8 col-sm-6 col-xs-6">
                            <input name="data[mobilephone][km][6s]" class="form-control required" placeholder="" value="{{isset($data['mobilephone'])?$data['mobilephone']['km']['6s']:0}}">
                        </div>
                    </div>
                    <div class="form-group clearfix">
                        <div class="col-lg-4 col-md-4 col-sm-6 col-xs-6">
                            <label>Block 1s</label>
                        </div>
                        <div class="col-lg-8 col-md-8 col-sm-6 col-xs-6">
                            <input name="data[mobilephone][km][1s]" class="form-control required" placeholder="" value="{{isset($data['mobilephone'])?$data['mobilephone']['km']['1s']:0}}">
                        </div>
                    </div>
                    <div class="form-group clearfix">
                        <div class="col-lg-4 col-md-4 col-sm-6 col-xs-6">
                            <label>Block 1 phut</label>
                        </div>
                        <div class="col-lg-8 col-md-8 col-sm-6 col-xs-6">
                            <input name="data[mobilephone][km][1p]" class="form-control required" placeholder="" value="{{isset($data['mobilephone'])?$data['mobilephone']['km']['1p']:0}}">
                        </div>
                    </div>
                </div>
            </fieldset>
        </div>
        <div class="box-body">
            <fieldset>
                <legend>DI ĐỘNG - Sử dụng đầu số nội mạng (Sử dụng dấu ',' để phân biệt đầu số)</legend>
                <div class="form-group clearfix">
                    <div class="col-lg-2 col-md-2 col-sm-12 col-xs-12">
                        <label>Đầu số nội mạng</label>
                    </div>
                    <div class="col-lg-10 col-md-10 col-sm-12 col-xs-12">
                        <input name="data[mobilephone][nm][codes]" class="form-control" placeholder="" value="{{isset($data['mobilephone'])?$data['mobilephone']['nm']['codes']:''}}">
                    </div>
                </div>
                <div class="form-group clearfix">
                    <div class="col-lg-2 col-md-2 col-sm-12 col-xs-12">
                        <label>Đầu số khác mạng</label>
                    </div>
                    <div class="col-lg-10 col-md-10 col-sm-12 col-xs-12">
                        <input name="data[mobilephone][km][codes]" class="form-control" placeholder="" value="{{isset($data['mobilephone'])?$data['mobilephone']['km']['codes']:''}}">
                    </div>
                </div>
            </fieldset>
        </div>
    </div>
    <div class="box box-primary">
        <div class="box-body">
            <fieldset>
                <div class="col-lg-6">
                    <legend class="">CỐ ĐỊNH - Nội mạng</legend>
                    <div class="form-group clearfix">
                        <div class="col-lg-4 col-md-4 col-sm-6 col-xs-6">
                            <label>Block 6s</label>
                        </div>
                        <div class="col-lg-8 col-md-8 col-sm-6 col-xs-6">
                            <input name="data[telephone][nm][6s]" class="form-control required" placeholder="" value="{{isset($data['telephone'])?$data['telephone']['nm']['6s']:0}}">
                        </div>
                    </div>
                    <div class="form-group clearfix">
                        <div class="col-lg-4 col-md-4 col-sm-6 col-xs-6">
                            <label>Block 1s</label>
                        </div>
                        <div class="col-lg-8 col-md-8 col-sm-6 col-xs-6">
                            <input name="data[telephone][nm][1s]" class="form-control required" placeholder="" value="{{isset($data['telephone'])?$data['telephone']['nm']['1s']:0}}">
                        </div>
                    </div>
                    <div class="form-group clearfix">
                        <div class="col-lg-4 col-md-4 col-sm-6 col-xs-6">
                            <label>Block 1 phut</label>
                        </div>
                        <div class="col-lg-8 col-md-8 col-sm-6 col-xs-6">
                            <input name="data[telephone][nm][1p]" class="form-control required" placeholder="" value="{{isset($data['telephone'])?$data['telephone']['nm']['1p']:0}}">
                        </div>
                    </div>
                </div>
                <div class="col-lg-6">
                    <legend class="">Khác mạng</legend>
                    <div class="form-group clearfix">
                        <div class="col-lg-4 col-md-4 col-sm-6 col-xs-6">
                            <label>Block 6s</label>
                        </div>
                        <div class="col-lg-8 col-md-8 col-sm-6 col-xs-6">
                            <input name="data[telephone][km][6s]" class="form-control required" placeholder="" value="{{isset($data['telephone'])?$data['telephone']['km']['6s']:0}}">
                        </div>
                    </div>
                    <div class="form-group clearfix">
                        <div class="col-lg-4 col-md-4 col-sm-6 col-xs-6">
                            <label>Block 1s</label>
                        </div>
                        <div class="col-lg-8 col-md-8 col-sm-6 col-xs-6">
                            <input name="data[telephone][km][1s]" class="form-control required" placeholder="" value="{{isset($data['telephone'])?$data['telephone']['km']['1s']:0}}">
                        </div>
                    </div>
                    <div class="form-group clearfix">
                        <div class="col-lg-4 col-md-4 col-sm-6 col-xs-6">
                            <label>Block 1 phut</label>
                        </div>
                        <div class="col-lg-8 col-md-8 col-sm-6 col-xs-6">
                            <input name="data[telephone][km][1p]" class="form-control required" placeholder="" value="{{isset($data['telephone'])?$data['telephone']['km']['1p']:0}}">
                        </div>
                    </div>
                </div>
            </fieldset>
        </div>
        <div class="box-body">
            <fieldset>
                <legend>CỐ ĐỊNH - Sử dụng đầu số nội mạng (Sử dụng dấu ',' để phân biệt đầu số)</legend>
                <div class="form-group clearfix">
                    <div class="col-lg-2 col-md-2 col-sm-12 col-xs-12">
                        <label>Đầu số nội mạng</label>
                    </div>
                    <div class="col-lg-10 col-md-10 col-sm-12 col-xs-12">
                        <input name="data[telephone][nm][codes]" class="form-control" placeholder="" value="{{isset($data['telephone'])?$data['telephone']['nm']['codes']:''}}">
                    </div>
                </div>
            </fieldset>
        </div>
        <div class="box-body">
            <fieldset>
                <legend>CỐ ĐỊNH - Nội hạt</legend>
                <div class="clearfix">
                    <div class="col-sm-6 col-xs-6">
                        <label>Chọn tỉnh (thành phố)</label>
                        <select name="data[telephone][nh][code]" class="form-control">
                            @foreach($provinces as $area_code => $province)
                            <option value="{{$area_code}}" {{isset($data['telephone']['nh']) && $data['telephone']['nh']['code'] == $area_code?'selected':''}}>{{$province}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-sm-6 col-xs-6">
                        <label>Đơn giá</label>
                        <input name="data[telephone][nh][price]" class="form-control" placeholder="" value="{{isset($data['telephone'])?$data['telephone']['nh']['price']:220}}">
                    </div
                </div>
            </fieldset>
        </div>
    </div>
    <div class="box box-primary">
        <div class="box-body">
            <fieldset>
                <legend>QUỐC TẾ (Đơn giá 1 phút) -  (Sử dụng dấu ',' để phân biệt đầu số)</legend>
                <div class="clearfix">
                    <legend>Trong nước, không tính là quốc tế </legend>
                    <div class="col-sm-10 col-xs-10">
                        <label>Country Codes</label>
                        <input name="data[international][0][codes]" class="form-control" placeholder="" value="{{isset($data['international'])?$data['international'][0]['codes']:0}}">
                    </div>
                    <div class="col-sm-2 col-xs-2">
                        <label>Đơn giá</label>
                        <input name="data[international][0][price]" class="form-control" placeholder="" value="{{isset($data['international'])?$data['international'][0]['price']:0}}">
                    </div>
                </div>
                <div class="clearfix">
                    <legend>Khu vực 1</legend>
                    <div class="col-sm-10 col-xs-10">
                        <label>Country Codes</label>
                        <input name="data[international][1][codes]" class="form-control" placeholder="" value="{{isset($data['international'])?$data['international'][1]['codes']:''}}">
                    </div>
                    <div class="col-sm-2 col-xs-2">
                        <label>Đơn giá</label>
                        <input name="data[international][1][price]" class="form-control" placeholder="" value="{{isset($data['international'])?$data['international'][1]['price']:''}}">
                    </div>
                </div>
                <div class="clearfix">
                    <legend>Khu vực 2</legend>
                    <div class="col-sm-10 col-xs-10">
                        <label>Country Codes</label>
                        <input name="data[international][2][codes]" class="form-control" placeholder="" value="{{isset($data['international'])?$data['international'][2]['codes']:''}}">
                    </div>
                    <div class="col-sm-2 col-xs-2">
                        <label>Đơn giá</label>
                        <input name="data[international][2][price]" class="form-control" placeholder="" value="{{isset($data['international'])?$data['international'][2]['price']:''}}">
                    </div>
                </div>
                <div class="clearfix">
                    <legend>Khu vực 3</legend>
                    <div class="col-sm-10 col-xs-10">
                        <label>Country Codes</label>
                        <input name="data[international][3][codes]" class="form-control" placeholder="" value="{{isset($data['international'])?$data['international'][3]['codes']:''}}">
                    </div>
                    <div class="col-sm-2 col-xs-2">
                        <label>Đơn giá</label>
                        <input name="data[international][3][price]" class="form-control" placeholder="" value="{{isset($data['international'])?$data['international'][3]['price']:''}}">
                    </div>
                </div>
                <div class="clearfix">
                    <legend>Khu vực 4</legend>
                    <div class="col-sm-10 col-xs-10">
                        <label>Country Codes</label>
                        <input name="data[international][4][codes]" class="form-control" placeholder="" value="{{isset($data['international'])?$data['international'][4]['codes']:''}}">
                    </div>
                    <div class="col-sm-2 col-xs-2">
                        <label>Đơn giá</label>
                        <input name="data[international][4][price]" class="form-control" placeholder="" value="{{isset($data['international'])?$data['international'][4]['price']:''}}">
                    </div>
                </div>
                <div class="clearfix">
                    <legend>Khu vực 5</legend>
                    <div class="col-sm-10 col-xs-10">
                        <label>Country Codes</label>
                        <input name="data[international][5][codes]" class="form-control" placeholder="" value="{{isset($data['international'])?$data['international'][5]['codes']:''}}">
                    </div>
                    <div class="col-sm-2 col-xs-2">
                        <label>Đơn giá</label>
                        <input name="data[international][5][price]" class="form-control" placeholder="" value="{{isset($data['international'])?$data['international'][5]['price']:''}}">
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
</form>
@endsection