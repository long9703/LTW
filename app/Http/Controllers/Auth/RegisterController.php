<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class RegisterController extends Controller
{
    public function showRegistrationForm()
    {
        return view('register'); 
    }

    public function register(Request $request)
    {
        // Validate input
        $request->validate([
            'fullname' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|confirmed|min:6',
            'phone_number' => 'required|string',
        ]);

        // Tạo người dùng mới
        $user = User::create([
            'fullname' => $request->fullname,
            'email' => $request->email,
            'password' =>$request->password,
            'phone_number' => $request->phone_number,
            'role_id' => 2, // Chọn role_id mặc định, nếu có
        ]);

        // Đăng nhập sau khi tạo tài khoản
        Auth::login($user);

        // Chuyển hướng người dùng đến trang chủ hoặc trang nào đó
        return redirect()->route('home');
    }
}
