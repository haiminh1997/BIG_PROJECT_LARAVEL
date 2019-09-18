@extends('admin.layouts.glance')

@section('title')
    Sửa đơn hàng
@endsection
@section('content')
    <h1>Sửa đơn hàng: {{$order->id.' : '.$order->customer_name}}</h1>
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    <div class="row">
        <div class="form-three widget-shadow">
            <form name="order" action="{{url('admin/shop/order/'.$order->id)}}" method="post" class="form-horizontal">
                @csrf
                <div class="form-group">
                    <label for="focusedinput" class="col-sm-2 control-label">Tên khách hàng</label>
                    <div class="col-sm-8">
                        <input type="text" name="customer_name" class="form-control1" id="focusedinput" value="{{$order->customer_name}}">
                    </div>
                </div>
                <div class="form-group">
                    <label for="focusedinput" class="col-sm-2 control-label">Email</label>
                    <div class="col-sm-8">
                        <input type="text" name="customer_email" class="form-control1" id="focusedinput" value="{{$order->customer_email}}">
                    </div>
                </div>
                <div class="form-group">
                    <label for="focusedinput" class="col-sm-2 control-label">SĐT</label>
                    <div class="col-sm-8">
                        <input type="text" name="customer_phone" class="form-control1" id="focusedinput" value="{{$order->customer_phone}}">
                    </div>
                </div>
                <div class="form-group">
                    <label for="focusedinput" class="col-sm-2 control-label">Địa chỉ</label>
                    <div class="col-sm-8">
                        <input type="text" name="customer_address" class="form-control1" id="focusedinput" value="{{$order->customer_address}}">
                    </div>
                </div>
                <div class="form-group">
                    <label for="focusedinput" class="col-sm-2 control-label">Thành phố</label>
                    <div class="col-sm-8">
                        <input type="text" name="customer_city" class="form-control1" id="focusedinput" value="{{$order->customer_city}}">
                    </div>
                </div>
                <div class="form-group">
                    <label for="focusedinput" class="col-sm-2 control-label">Quốc gia</label>
                    <div class="col-sm-8">
                        <input type="text" name="customer_country" class="form-control1" id="focusedinput" value="{{$order->customer_country}}">
                    </div>
                </div>
                <div class="form-group">
                    <label for="focusedinput" class="col-sm-2 control-label">Tổng tiền</label>
                    <div class="col-sm-8">
                        <input type="text" name="total_price" class="form-control1" id="focusedinput" value="{{$order->total_price}}">
                    </div>
                </div>
                <div class="form-group">
                    <label for="focusedinput" class="col-sm-2 control-label">Trạng thái</label>
                    <div class="col-sm-8">
                        <select name="status" id="status_select">
                                <?php $selected = $order->status == 0 ? ' selected' : ''; ?>
                            <option value="0" {{$selected}}>Chưa thanh toán</option>
                                <?php $selected = $order->status == 1 ? ' selected' : ''; ?>
                            <option value="1" {{$selected}}>Đã thanh toán</option>
                                <?php $selected = $order->status == 2 ? ' selected' : ''; ?>
                            <option value="2" {{$selected}}>Đang vận chuyển</option>
                                <?php $selected = $order->status == 3 ? ' selected' : ''; ?>
                            <option value="3" {{$selected}}>Đã giao hàng</option>
                                <?php $selected = $order->status == 4 ? ' selected' : ''; ?>
                            <option value="4" {{$selected}}>Hủy đơn</option>
                        </select>
                    </div>
                </div>
                <div class="form-group">
                    <label for="txtarea1" class="col-sm-2 control-label">Ghi chú</label>
                    <div class="col-sm-8"><textarea name="customer_note" id="txtarea1" cols="50" rows="4" class="form-control1 mytinymce">{{$order->customer_note}}</textarea></div>
                </div>

                <div class="col-sm-offset-2">
                    <button type="submit" class="btn btn-warning">Sửa</button>
                </div>
            </form>
        </div>
    </div>


@endsection

