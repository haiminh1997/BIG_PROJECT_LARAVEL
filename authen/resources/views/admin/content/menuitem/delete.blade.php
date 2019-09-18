@extends('admin.layouts.glance')
@section('title')
    Xóa menu
@endsection
@section('content')
    <h1> Xóa menu {{ $menu->id . ' : ' .$menu->name }}</h1>
    <div class="row">
        <div class="form-three widget-shadow">
            <form name="menu" action="{{ url('admin/menuitems/'.$menu->id.'/delete') }}" method="post" class="form-horizontal">
                @csrf
                <div class="form-group">
                    <label for="focusedinput" class="col-sm-2 control-label">Tên menu</label>
                    <div class="col-sm-8">
                        <input type="text" name="name" class="form-control1" id="focusedinput" value="{{ $menu->name }}" placeholder="Tên menu">
                    </div>
                </div>
                <div class="col-sm-offset-2">
                    <button type="submit" class="btn btn-danger">Xóa</button>
                </div>
            </form>
        </div>
    </div>
@endsection

