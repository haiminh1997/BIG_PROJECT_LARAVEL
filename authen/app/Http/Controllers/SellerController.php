<?php

namespace App\Http\Controllers;

use App\Model\SellerModel;
use Illuminate\Http\Request;

class SellerController extends Controller
{
    /**
     * Hàm khởi tạo của class được chạy ngay khi khởi tạo đối tượng
     * Hàm này luôn được chạy trước các hàm khác trong class
     * SellerController constructor.
     */
    public  function __construct()
    {
        /**
         * truyền vào goute là admin
         * tương tự như middleware của khách hàng trong file homecontroller
         * nhưng có phương thức cụ thể là admin
         * chỉ xác thực với index
         */
        $this->middleware('auth:seller')-> only('index');
    }
    /**
     * Phương thức trả về view khi đăng nhập seller thành công
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index(){
        return view('seller.dashboard');
    }

    /**
     * Được gọi đến trong view của file web.php
     * Phương thức trả về view để đăng ký tài khoản seller
     */
    public function create(){
        return view('seller.auth.register');
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
        $sellerModel = new SellerModel();
        $sellerModel->name = $request->name;
        $sellerModel->email = $request->email;
        $sellerModel->password=  bcrypt($request->password) ;
        $sellerModel->save();

        //@todo
        // sau khi đăng ký thành công tạo xong dữ liệu sẽ redirect về route đăng nhập
        return redirect()->route('seller.auth.login');

    }
}
