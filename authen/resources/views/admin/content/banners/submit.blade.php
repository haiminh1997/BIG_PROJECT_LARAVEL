@extends('admin.layouts.glance')
@section('title')
    Thêm mới banner
@endsection
@section('content')
    <h1>Thêm mới banner</h1>
    <div class="row">
        <div class="form-three widget-shadow">
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            <form name="page" action="{{ url('admin/banners') }}" method="post" class="form-horizontal">
                @csrf
                <div class="form-group">
                    <label for="focusedinput" class="col-sm-2 control-label">Tên sản phẩm</label>
                    <div class="col-sm-8">
                        <input type="text" name="name" value="{{ old('name') }}" class="form-control1" id="focusedinput" placeholder="Tên banner">
                    </div>
                </div>
                <div class="form-group">
                    <label for="focusedinput" class="col-sm-2 control-label">Link</label>
                    <div class="col-sm-8">
                        <input type="text" name="link" value="{{ old('link') }}" class="form-control1" id="focusedinput" placeholder="link">
                    </div>
                </div>

                <div class="form-group">
                    <label for="focusedinput" class="col-sm-2 control-label">Vị trí</label>
                    <div class="col-sm-8">
                        <select name="location_id">
                            <option value="0">Không hiện</option>
                            @foreach($locations as $key_location => $location)
                                <option value="{{ $key_location }}" >{{$location}}</option>
                                @endforeach
                        </select>
                    </div>
                </div>

                <div class="form-group">
                    <label for="focusedinput" class="col-sm-2 control-label">Image</label>
                    <div class="col-sm-8">
                        <span class="input-group-btn">
                         <a id="lfm" data-input="thumbnai" data-preview="holder" class="lfm-btn btn btn-primary">
                           <i class="fa fa-picture-o"></i> Choose
                         </a>
                        </span>
                        <input id="thumbnai" class="form-control" type="text" name="image" value="{{old('image')}}" placeholder="Hình ảnh">
                        <img id="holder" style="margin-top:15px;max-height:100px;">
                    </div>
                </div>

                <div class="form-group">
                    <label for="txtarea1" class="col-sm-2 control-label">Mô tả ngắn</label>
                    <div class="col-sm-8"><textarea name="intro" id="txtarea1" cols="50" rows="4" class="form-control1 mytinymce">{{ old('intro') }}</textarea></div>
                </div>
                <div class="form-group">
                    <label for="txtarea1" class="col-sm-2 control-label">Mô tả</label>
                    <div class="col-sm-8"><textarea name="desc" id="txtarea1" cols="50" rows="4" class="form-control1 mytinymce">{{ old('desc') }}</textarea></div>
                </div>

                <div class="col-sm-offset-2">
                    <button type="submit" class="btn btn-success">Submit</button>
                </div>
            </form>
        </div>
    </div>
    <script src="{{asset('/vendor/laravel-filemanager/js/lfm.js')}}"></script>
    <script type="text/javascript">
        $(document).ready(function () {
            var domain = "http://localhost/authen/public/laravel-filemanager";
            $('.lfm-btn').filemanager('image', {prefix: domain});
        });
    </script>
@endsection
