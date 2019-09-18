@extends('admin.layouts.glance')
@section('title')
    Xóa danh mục
@endsection
@section('content')
    <h1>Xóa danh mục {{ $cat->id . ' : ' .$cat->name }}</h1>
    <div class="row">
        <div class="form-three widget-shadow">
            <form name="category" action="{{ url('admin/content/category/'.$cat->id.'/delete') }}" method="post" class="form-horizontal">
                @csrf
                <div class="form-group">
                    <label for="focusedinput" class="col-sm-2 control-label">Tên danh mục</label>
                    <div class="col-sm-8">
                        <input type="text" name="name" class="form-control1" id="focusedinput" value="{{ $cat->name }}" placeholder="Tên danh mục">
                    </div>
                </div>
                <div class="col-sm-offset-2">
                    <button type="submit" class="btn btn-danger">Xóa</button>
                </div>
            </form>
        </div>
    </div>
@endsection
