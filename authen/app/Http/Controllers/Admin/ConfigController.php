<?php

namespace App\Http\Controllers\Admin;

use App\Model\Admin\ConfigModel;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ConfigController extends Controller
{
    //
    public function __construct()
    {
        $this->middleware("auth:admin");
    }
    public function index(){

        $config[] = array();
        $config[0] = 'web_name';
        $config[1] = 'header_logo';
        $config[2] = 'footer_logo';
        $config[3] = 'intro';
        $config[4] = 'desc';

        /*
         * tạo giá trị mặc định cho mảng default
         */
        $default = array();
        foreach ($config as $item_config){
            if (!isset($default[$item_config])){
                $default[$item_config] = '';
            }
        }
        /*
         * Lấy từ CSDL ra đè lại cái default
         */
        $items = ConfigModel::all();
        foreach($items as $item){
            $key = $item->name;
            $default[$key] = $item->value;
        }

        $data = array();
        $data['configs'] = $default;

        return view('admin.content.config.index',$data);
    }
    public function store(Request $request ) {
        $input = $request->all();
        $config[] = array();
        $config[0] = 'web_name';
        $config[1] = 'header_logo';
        $config[2] = 'footer_logo';
        $config[3] = 'intro';
        $config[4] = 'desc';


        foreach ($config as $item_config){
            $record = ConfigModel::where('name',$item_config)->first();
            if (isset($record->id)){ // nếu đã tồn tại thì update
                $item = ConfigModel::find($record->id);
                $item->value = isset($input[$item_config]) ? $input[$item_config] : '';
                $item->default = '';
                $item->save();
            } else { // nếu chưa tồn tại thì tao mới
                $item = new ConfigModel();
                $item->name = $item_config;
                $item->value = isset($input[$item_config]) ? $input[$item_config] : '';
                $item->default = '';
                $item->save();
            }
        }

        return redirect('/admin/config');
    }
}
