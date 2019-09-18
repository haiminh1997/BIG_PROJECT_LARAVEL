<?php

namespace App\Http\Controllers;

use App\Model\ShipperModel;
use Illuminate\Http\Request;

class ShipperController extends Controller
{
    //
    /**
     * Hàm khởi tạo của class được chạy ngay khi khởi tạo đối tượng
     * Hàm này luôn được chạy trước các hàm khác trong class
     * ShipperController constructor.
     */
    public  function __construct()
    {
        /**
         * truyền vào goute là admin
         * tương tự như middleware của khách hàng trong file homecontroller
         * nhưng có phương thức cụ thể là admin
         * chỉ xác thực với index
         */
        $this->middleware('auth:shipper')-> only('index');
    }

    /**
     * Phương thức trả về view khi đăng nhập shipper thành công
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index(){
        return view('shipper.dashboard');
    }

    /**
     * Được gọi đến trong view của file web.php
     * Phương thức trả về view để đăng ký tài khoản shipper
     */
    public function create(){
        return view('shipper.auth.register');
    }


    /**
     * Được gọi đến trong xử lý dữ liệu của file web.php
     * request lấy tất cả dữ liệu đc gửi đi
     */
    public function store(Request $request){
        // validate dữ liệu được gửi từ form(điều kiện của các trường dữ liệu)
        $this->validate($request, array(
            'name' => 'required',
            'email' => 'required',
            'password' => 'required'
        ));

        // Khởi tạo model để lưu admin mới
        $shipperModel = new ShipperModel();
        $shipperModel->name = $request->name;
        $shipperModel->email = $request->email;
        $shipperModel->password=  bcrypt($request->password) ;
        $shipperModel->save();

        //@todo
        // sau khi đăng ký thành công tạo xong dữ liệu sẽ redirect về route đăng nhập
        return redirect()->route('shipper.auth.login');

    }


}
