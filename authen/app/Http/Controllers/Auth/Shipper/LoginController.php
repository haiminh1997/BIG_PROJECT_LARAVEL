<?php

namespace App\Http\Controllers\Auth\Shipper;

use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
class LoginController extends Controller
{
    use AuthenticatesUsers;
    public function __construct()
    {
        /**
         * Muốn vào loginController thì phải qua 1 cái gourd là shipper
         * Ngoại trừ cái logout
         */
        $this->middleware('guest:shipper')->except('logout');

    }

    /**
     * Phương thức này trả về view đăng nhập cho admin
     */
    public function login(){
        return view('shipper.auth.login');
    }

    /**
     * Phương thức này dùng để đăng nhập cho shipper
     * lấy thông tin từ form có method là POST
     */
    public function loginShipper(Request $request){
        // validate dữ liệu đăng nhâp
        $this->validate($request, array(
            'email' => 'required|email',
            'password' => 'required|min:6'
        ));

        /**
         * Đăng nhập cho guard là admin
         * attempt là phương thức dành cho đăng nhập
         * gồm 2 tham số 1 mảng và remember
         */
        if(Auth::guard('shipper')->attempt(
            [
                'email' => $request->email ,
                'password' => $request->password
            ],
            $request->remember
        )
        ){
            //Nếu đăng nhập thành công thì trả về view dashboard của admin
            return redirect()->intended(route('shipper.dashboard'));
        }
        /**
         * nếu đăng nhập thất bại thì quay trở về form đăng nhập
         * với giá trị của 2 ô input cũ là email và remember
         */
        return redirect()->back()->withInput($request->only('email','remember'));
    }

    /**
     * Phương thức này dùng để đăng xuất
     */
    public function logout(){
        Auth::guard('shipper')->logout();
        // chuyển hướng về trang login của seller
        return redirect()->route('shipper.auth.login');
    }
}
