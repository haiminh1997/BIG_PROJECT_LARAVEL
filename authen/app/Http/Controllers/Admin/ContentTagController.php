<?php

namespace App\Http\Controllers\Admin;

use App\Model\Admin\ContentTagModel;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
class ContentTagController extends Controller
{
    public  function __construct()
    {
        $this->middleware('auth:admin');
    }
    public function index(){
        $items = DB::table('content_tags')->paginate(8);
        /**
         * Đây là biến truyền từ controller xuống view
         */
        $data= array();
        $data['tags']= $items; // truy cập tên biến là tags trong phần view
        return view('admin.content.content.tag.index',$data);
    }
    public function create(){
        /**
         * Đây là biến truyền từ controller xuống view
         */
        $data= array();
        return view('admin.content.content.tag.submit',$data);
    }
    public function slugify($str){
        $str = trim(mb_strtolower($str));
        $str = preg_replace('/(à|á|ạ|ã|ả|â|ầ|ấ|ậ|ẫ|ẩ|ă|ằ|ắ|ẵ|ặ|ẳ)/','a',$str);
        $str = preg_replace('/(è|é|ẹ|ẽ|ẻ|ê|ề|ế|ể|ễ|ệ)/','e',$str);
        $str = preg_replace('/(ì|í|ĩ|ỉ|ị)/','i',$str);
        $str = preg_replace('/(ò|ó|ỏ|õ|ọ|ô|ồ|ố|ổ|ỗ|ộ|ơ|ờ|ớ|ở|ỡ|ỡ)/','o',$str);
        $str = preg_replace('/(ú|ù|ũ|ủ|ụ|ư|ứ|ừ|ử|ữ|ự)/','u',$str);
        $str = preg_replace('/(ý|ỳ|ỷ|ỹ|ỵ)/','y',$str);
        $str = preg_replace('/(đ)/','d',$str);
        $str = preg_replace('/[^a-z0-9-\s]/','',$str);
        $str = preg_replace('/([\s]+)/','-',$str);
        return $str;
    }
    public function edit($id){
        /**
         * Đây là biến truyền từ controller xuống view
         */
        $data= array();
        $item = ContentTagModel::find($id);
        $data['tag']= $item;
        return view('admin.content.content.tag.edit',$data);
    }
    public function delete($id){
        /**
         * Đây là biến truyền từ controller xuống view
         */
        $data= array();
        $item = ContentTagModel::find($id);
        $data['tag']= $item;
//        $data['id']= $id;
        return view('admin.content.content.tag.delete',$data);
    }
    public function store(Request $request){
        $validatedData = $request->validate([
            'name' => 'required|max:255',
            'images' => 'required',
            'intro' => 'required',
        ]);

        $input = $request->all();
        $item = new ContentTagModel();

        $item->name = $input['name'];
        $item->slug = $input['slug'] ? $this->slugify($input['slug']) : $this->slugify($input['name']);
        $item->images = $input['images'];
        $item->intro = $input['intro'];
        $item->author_id = isset( $input['author_id'] ) ? $input['author_id'] : 0;
        $item->view = isset($input['view']) ? $input['view'] : 0;
        $item->save();
        return redirect('/admin/content/tag');
    }
    public function update(Request $request, $id){

        $validatedData = $request->validate([
            'name' => 'required|max:255',
            'images' => 'required',
            'intro' => 'required',
        ]);

        $input = $request->all();
        $item = ContentTagModel::find($id);

        $item->name = $input['name'];
        $item->slug = $input['slug'] ? $this->slugify($input['slug']) : $this->slugify($input['name']);
        $item->images = $input['images'];
        $item->intro = $input['intro'];
        $item->author_id = isset( $input['author_id'] ) ? $input['author_id'] : 0;
        $item->view = isset($input['view']) ? $input['view'] : 0;
        $item->save();
        return redirect('/admin/content/tag');

    }
    public function destroy($id){
        $item = ContentTagModel::find($id);
        $item->delete();
        return redirect('/admin/content/tag');
    }
}
