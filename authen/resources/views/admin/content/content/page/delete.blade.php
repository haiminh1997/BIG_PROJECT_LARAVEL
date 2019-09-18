@extends('admin.layouts.glance')
@section('title')
    Xóa trang
@endsection
@section('content')
    <h1> Xóa trang {{ $page->id . ' : ' .$page->name }}</h1>
    <div class="row">
        <div class="form-three widget-shadow">
            <form name="page" action="{{ url('admin/content/page/'.$page->id.'/delete') }}" method="post" class="form-horizontal">
                @csrf
                <div class="form-group">
                    <label for="focusedinput" class="col-sm-2 control-label">Tên trang</label>
                    <div class="col-sm-8">
                        <input type="text" name="name" class="form-control1" id="focusedinput" value="{{ $page->name }}" placeholder="Tên sản phẩm">
                    </div>
                </div>
                <div class="col-sm-offset-2">
                    <button type="submit" class="btn btn-danger">Xóa</button>
                </div>
            </form>
        </div>
    </div>
@endsection

