@extends('admin.layouts.glance')
@section('title')
    Sửa sản phẩm
@endsection
@section('content')
    <h1>Sửa sản phẩm {{ $product->id . ' : ' .$product->name }}</h1>
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
            <form name="shop_product" action="{{ url('admin/shop/product/'.$product->id) }}" method="post" class="form-horizontal">
                @csrf
                <div class="form-group">
                    <label for="focusedinput" class="col-sm-2 control-label">Tên sản phẩm</label>
                    <div class="col-sm-8">
                        <input type="text" name="name" class="form-control1" id="focusedinput" value="{{ $product->name }}" placeholder="Tên sản phẩm">
                    </div>
                </div>
                <div class="form-group">
                    <label for="focusedinput" class="col-sm-2 control-label">Danh mục</label>
                    <div class="col-sm-8">
                        <select name="cat_id">
                            <option value="0">Không có danh mục</option>
                            {{--$cats lấy từ index trong ShopProductController--}}
                            @foreach($cats as $cat)
                                <option value="{{ $cat->id }}" <?php echo ($product->cat_id == $cat->id) ? 'selected' : ''?>>{{$cat->name}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="form-group">
                    <label for="focusedinput" class="col-sm-2 control-label">Homepage</label>
                    <div class="col-sm-8">
                        <select name="homepage">
                            <option value="0" <?php echo ($product->homepage == 0) ? 'selected' : ''?>>Không</option>
                            <option value="1" <?php echo ($product->homepage == 1) ? 'selected' : ''?>>Có</option>
                        </select>
                    </div>
                </div>
                <div class="form-group">
                    <label for="focusedinput" class="col-sm-2 control-label">Slug</label>
                    <div class="col-sm-8">
                        <input type="text" name="slug" class="form-control1" id="focusedinput" value="{{ $product->slug }}" placeholder="Slug">
                    </div>
                </div>

                <?php
                    $images = $product->images ? json_decode($product->images) : array();
                    $i=0;
                ?>

                @foreach($images as $image)
                   <?php  $i++ ?>
                    <div class="form-group">
                        <label for="focusedinput" class="col-sm-2 control-label">Images{{ $i }}</label>
                        <div class="col-sm-8">
                        <span class="input-group-btn">
                            <a id="lfm{{ $i }}" data-input="thumbnail{{ $i }}" data-preview="holder{{ $i }}" class="lfm-btn btn btn-primary">
                            <i class="fa fa-picture-o"></i> Thêm
                            </a>
                            <a class="btn btn-warning remove-image">
                                <i class="fa fa-remove"></i> Xóa
                            </a>
                        </span>
                            <input id="thumbnail{{ $i }}" class="form-control" type="text" name="images[]" value="{{ $image }}" placeholder="Ảnh">
                            <img id="holder{{ $i }}" src="{{ asset($image) }}" style="margin-top:15px;max-height:100px;">
                        </div>
                    </div>
                        @endforeach

                <div class="form-group">
                    <label for="focusedinput" class="col-sm-2 control-label">Thêm ảnh</label>
                    <div class="col-sm-8">
                        <a id="plus-image" class="btn btn-success">
                            <i class="fa fa-plus"></i> Thêm
                        </a>
                    </div>
                </div>

                <div class="form-group">
                    <label for="focusedinput" class="col-sm-2 control-label">Gía niêm yết</label>
                    <div class="col-sm-8">
                        <input type="text" name="priceCore" class="form-control1" id="focusedinput" value="{{ $product->priceCore }}" placeholder="Gía niêm yết">
                    </div>
                </div>
                <div class="form-group">
                    <label for="focusedinput" class="col-sm-2 control-label">Gía bán</label>
                    <div class="col-sm-8">
                        <input type="text" name="priceSale" class="form-control1" id="focusedinput" value="{{ $product->priceSale }}" placeholder="Giá bán">
                    </div>
                </div>
                <div class="form-group">
                    <label for="focusedinput" class="col-sm-2 control-label">Tồn kho</label>
                    <div class="col-sm-8">
                        <input type="text" name="stock" class="form-control1" id="focusedinput" value="{{ $product->stock }}" placeholder="Tồn kho">
                    </div>
                </div>
                <div class="form-group">
                    <label for="focusedinput" class="col-sm-2 control-label">Thông tin vận chuyển</label>
                    <div class="col-sm-8">
                        <input type="text" name="ship_info" value="{{ $product->ship_info }}" class="form-control1" id="focusedinput" placeholder="Thông tin vận chuyển">
                    </div>
                </div>
                <div class="form-group">
                    <label for="txtarea1" class="col-sm-2 control-label">Mô tả ngắn</label>
                    <div class="col-sm-8"><textarea name="intro"  id="txtarea1" cols="50" rows="4" class="form-control1 mytinymce">{{ $product->intro }}</textarea></div>
                </div>
                <div class="form-group">
                    <label for="txtarea1" class="col-sm-2 control-label">Mô tả</label>
                    <div class="col-sm-8"><textarea name="desc"  id="txtarea1" cols="50" rows="4" class="form-control1 mytinymce">{{ $product->desc }}</textarea></div>
                </div>
                <div class="form-group">
                    <label for="txtarea1" class="col-sm-2 control-label">Thông tin bổ sung</label>
                    <div class="col-sm-8"><textarea name="additional_information" id="txtarea1" cols="50" rows="4" class="form-control1 mytinymce">{{ $product->additional_information }}</textarea></div>
                </div>
                <div class="form-group">
                    <label for="txtarea1" class="col-sm-2 control-label">Đánh giá</label>
                    <div class="col-sm-8"><textarea name="review" id="txtarea1" cols="50" rows="4" class="form-control1 mytinymce">{{ $product->review }}</textarea></div>
                </div>
                <div class="form-group">
                    <label for="txtarea1" class="col-sm-2 control-label">Trợ giúp</label>
                    <div class="col-sm-8"><textarea name="help" id="txtarea1" cols="50" rows="4" class="form-control1 mytinymce">{{ $product->help }}</textarea></div>
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
            // var domain = "http://localhost/PROJECT_LARAVEL/authen/public/laravel-filemanager";
            // $('.lfm-btn').filemanager('image', {prefix: domain});
            $('#plus-image').on('click', function (e) {
                e.preventDefault(); // Đê không bị chuyển hướng của thẻ a có id: plus-image
                var lfm_btn_length = $('.lfm-btn').length;
                var lfm_id_next = lfm_btn_length + 1;
                var html = '';
                html += '<div class="form-group">\n' +
                    '                    <label for="focusedinput" class="col-sm-2 control-label">Hình ảnh</label>\n' +
                    '                    <div class="col-sm-8">\n' +
                    '\n' +
                    '                        <span class="input-group-btn">\n' +
                    '                         <a id="lfm'+lfm_id_next+'" data-input="thumbnail'+lfm_id_next+'" data-preview="holder'+lfm_id_next+'" class="lfm-btn btn btn-primary">\n' +
                    '                           <i class="fa fa-picture-o"></i> Choose\n' +
                    '                         </a>\n' +
                    '                         <a class="btn btn-warning remove-image">\n' +
                    '                           <i class="fa fa-remove"></i> Xóa\n' +
                    '                         </a>\n' +
                    '                        </span>\n' +
                    '                        <input id="thumbnail'+lfm_id_next+'" class="form-control" type="text" name="images[]" placeholder="Hình ảnh">\n' +
                    '\n' +
                    '                        <img id="holder'+lfm_id_next+'" style="margin-top:15px;max-height:100px;">\n' +
                    '\n' +
                    '                    </div>\n' +
                    '\n' +
                    '                </div>';
                var box = $(this).closest('.form-group')
                $(html).insertBefore(box);
                var domain = "http://localhost/authen/public/laravel-filemanager";
                $('.lfm-btn').filemanager('image', {prefix: domain});
            });
            $(body).on('click','.remove-image',function (e) {
                e.preventDefault();
                $(this).closest('.form-group').remove();
            });
        });
    </script>
@endsection
