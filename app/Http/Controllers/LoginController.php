<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function register()
    {
        return view('register');
    }
    public function login()
    {
        return view('login');
    }

    //Đăng ký
    public function postRegister(Request $request)
    {
        $data = $request->all();
        User::query()->create($data);
        return redirect()->route('login');
    }
    //Login
    public function postLogin(Request $request)
    {
        $data = $request->only(['email', 'password']);
        //Kiểm tra đăng nhập
        if (Auth::attempt($data)) {
            return redirect()->route('post.index');
        } else {
            return redirect()->back()->with('message', 'Email hoặc Password không chính xác');
        }
    }

    public function logout()
    {
        Auth::logout();
        return redirect()->route('login');
    }
}
