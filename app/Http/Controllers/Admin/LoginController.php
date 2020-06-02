<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Hash;

class LoginController extends Controller
{
    public function index()
    {
        return view('admin.login');
    }

    public function process(Request $request)
    {
        $username   = $request->username;
        $password   = $request->password;

        // Get Username Admin
        $admin      = DB::table('admin')->where('username', $username)->first();
        if ($admin != null) {
            if (Hash::check($password, $admin->password)) {
                Session::put('name', $admin->name);
                Session::put('username', $admin->username);
                Session::put('login', 'login');
                return redirect('/admin/home')->with('status', 'Selamat Datang di Admin Shath ID');
            } else {
                return redirect('/admin/login')->with('status', 'Password Salah');
            }
        } else {
            return redirect('/admin/login')->with('status', 'Username Salah');
        }
    }

    public function logout()
    {
        Session::flush();
        return redirect('admin/login')->with('status', 'Session anda telah habis !');
    }
}
