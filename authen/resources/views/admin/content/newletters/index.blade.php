@extends('admin.layouts.glance')

@section('title')
   Newletters
@endsection
@section('content')
    <h1>  Newletters </h1>
    <div style="margin: 20px 0;" class="btn btn-success">
        <a href="{{url ('admin/newletters/create')}}">Thêm Newletter</a>
    </div>
    <div class="tables">
        <div class="table-responsive bs-example widget-shadow">
            <h4>Tổng số:  {{$total}}</h4>
            <table class="table table-bordered">
                <thead>
                <tr>
                    <th>#</th>
                    <th>Email</th>
                    <th></th>
                </tr>
                </thead>
                <tbody>
                @foreach($newletters as $newletter)
                    <tr>
                        <th scope="row">{{$newletter->id}}</th>
                        <td>{{$newletter->email}}</td>
                        <td>
                            <a href="{{url('admin/newletters/'.$newletter->id.'/edit')}}" class="btn btn-warning">Sửa</a>
                            <a href="{{url('admin/newletters/'.$newletter->id.'/delete')}}" class="btn btn-danger">Xóa</a>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
            {{ $newletters->links() }}
        </div>
    </div>
@endsection

