@extends('admin.layouts.glance')
@section('title')
    Xóa sản phẩm
@endsection
@section('content')
    <h1> Xóa sản phẩm {{ $product->id . ' : ' .$product->name }}</h1>
    <div class="row">
        <div class="form-three widget-shadow">
            <form name="product" action="{{ url('admin/shop/product/'.$product->id.'/delete') }}" method="post" class="form-horizontal">
                @csrf
                <div class="form-group">
                    <label for="focusedinput" class="col-sm-2 control-label">Tên sản phẩm</label>
                    <div class="col-sm-8">
                        <input type="text" name="name" class="form-control1" id="focusedinput" value="{{ $product->name }}" placeholder="Tên sản phẩm">
                    </div>
                </div>
                <div class="col-sm-offset-2">
                    <button type="submit" class="btn btn-danger">Xóa</button>
                </div>
            </form>
        </div>
    </div>
@endsection
