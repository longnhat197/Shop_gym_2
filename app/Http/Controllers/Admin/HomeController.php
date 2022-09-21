<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Utilities\Constant;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{

    public function getLogin(){
        return view('admin.login');
    }

    public function postLogin(Request $request){
        $credentials = [
            'email' => $request->email,
            'password' => $request->password,
            'level' => [Constant::user_level_host,Constant::user_level_admin], //Tài khoản khách hàng cấp độ host hoặc admin
        ];

        $remember = $request->remember;

        if (Auth::attempt($credentials, $remember)) {

            return redirect()->intended('admin'); // Mặc định là trang chủ
        } else {
            return back()->with('notification', 'ERROR: Email or password is incorrect');
        }
    }

    public function logout(){
        Auth::logout();
        return redirect('admin/login');
    }
}
