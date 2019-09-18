@extends('admin.layouts.glance')
@section('title')
    Xóa admin
@endsection
@section('content')
    <h1>Xóa danh mục {{ $admin->id . ' : ' .$admin->name }}</h1>
    <div class="row">
        <div class="form-three widget-shadow">
            <form name="admin" action="{{ url('admin/shop/users/'.$admin->id.'/delete') }}" method="post" class="form-horizontal">
                @csrf
                <div class="form-group">
                    <label for="focusedinput" class="col-sm-2 control-label">Tên admin</label>
                    <div class="col-sm-8">
                        <input type="text" name="name" class="form-control1" id="focusedinput" value="{{ $admin->name }}" placeholder="Tên admin">
                    </div>
                </div>
                <div class="col-sm-offset-2">
                    <button type="submit" class="btn btn-danger">Xóa</button>
                </div>
            </form>
        </div>
    </div>
@endsection
