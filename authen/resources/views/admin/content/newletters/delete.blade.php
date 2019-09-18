@extends('admin.layouts.glance')

@section('title')
    Xóa Newletter
@endsection
@section('content')
    <h1>Xóa Newletter: {{$newletter->id}}</h1>
    <div class="row">
        <div class="form-three widget-shadow">
            <form name="newletter" action="{{url('admin/newletters/'.$newletter->id.'/delete')}}" method="post" class="form-horizontal">
                @csrf
                <div class="col-sm-offset-2">
                    <button type="submit" class="btn btn-danger">Xóa</button>
                </div>
            </form>
        </div>
    </div>

@endsection

