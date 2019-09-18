<?php

namespace App\Http\Controllers\Admin;

use App\Model\Admin\ShopBrandModel;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;


class ShopBrandController extends Controller
{
    public  function __construct()
    {
        $this->middleware('auth:admin');
    }
    public function index(){
        $items = DB::table('shop_brands')->paginate(8);
        /**
         * Đây là biến truyền từ controller xuống view
         */
        $data= array();
        $data['brands']= $items; // truy cập tên biến là tags trong phần view
        return view('admin.content.shop.brand.index',$data);
    }
    public function create(){
        $data= array();
        return view('admin.content.shop.brand.submit',$data);
    }
    public function edit($id){
        $data= array();
        $item = ShopBrandModel::find($id);
        $data['brand']= $item;
        return view('admin.content.shop.brand.edit',$data);
    }
    public function delete($id){
        $data= array();
        $item = ShopBrandModel::find($id);
        $data['brand']= $item;
        return view('admin.content.shop.brand.delete',$data);
    }

    public function store(Request $request){
        $validatedData = $request->validate([
            'name' => 'required|max:255',
            'image' => 'required',
            'link' => 'required',
        ]);

        $input = $request->all();
        $item = new ShopBrandModel();

        $item->name = $input['name'];
        $item->image = $input['image'];
        $item->link = $input['link'];
        $item->intro = isset( $input['intro'] ) ? $input['intro'] : '';
        $item->desc = isset( $input['desc'] ) ? $input['desc'] : '';

        $item->save();
        return redirect('/admin/shop/brand');
    }
    public function update(Request $request, $id){

        $validatedData = $request->validate([
            'name' => 'required|max:255',
            'image' => 'required',
            'link' => 'required',
        ]);

        $input = $request->all();
        $item = ShopBrandModel::find($id);

        $item->name = $input['name'];
        $item->image = $input['image'];
        $item->link = $input['link'];
        $item->intro = isset( $input['intro'] ) ? $input['intro'] : '';
        $item->desc = isset( $input['desc'] ) ? $input['desc'] : '';

        $item->save();
        return redirect('/admin/shop/brand');

    }
    public function destroy($id){
        $item = ShopBrandModel::find($id);
        $item->delete();
        return redirect('/admin/shop/brand');
    }

}
