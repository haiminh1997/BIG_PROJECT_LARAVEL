@extends('admin.layouts.glance')
@section('title')
    Xóa tag
@endsection
@section('content')
    <h1> Xóa tag {{ $tag->id . ' : ' .$tag->name }}</h1>
    <div class="row">
        <div class="form-three widget-shadow">
            <form name="tag" action="{{ url('admin/content/tag/'.$tag->id.'/delete') }}" method="post" class="form-horizontal">
                @csrf
                <div class="form-group">
                    <label for="focusedinput" class="col-sm-2 control-label">Tên tag</label>
                    <div class="col-sm-8">
                        <input type="text" name="name" class="form-control1" id="focusedinput" value="{{ $tag->name }}" placeholder="Tên sản phẩm">
                    </div>
                </div>
                <div class="col-sm-offset-2">
                    <button type="submit" class="btn btn-danger">Xóa</button>
                </div>
            </form>
        </div>
    </div>
@endsection

