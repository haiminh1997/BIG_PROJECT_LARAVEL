@extends('admin.layouts.glance')

@section('title')
    Xóa đơn hàng
@endsection
@section('content')
    <h1>Xóa đơn hàng: {{$order->id.' : '.$order->customer_name}}</h1>
    <div class="row">
        <div class="form-three widget-shadow">
            <form name="order" action="{{url('admin/shop/order/'.$order->id.'/delete')}}" method="post" class="form-horizontal">
                @csrf
                <div class="col-sm-offset-2">
                    <button type="submit" class="btn btn-danger">Xóa</button>
                </div>
            </form>
        </div>
    </div>

@endsection
