<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class AuthController extends Controller
{
    /**
     * @param Request $request
     * 
     * @return [type]
     */
    public function login(Request $request) 
    {
        $credentials =  $request->only('email', 'password');

        if (Auth::guard('admin')->attempt($credentials)) {
            return redirect('admin/index');
        }
        else{
            return view('admin.login')->with('msg', 'Wrong username or password!!!');
        }
    }

    /**
     * @return [type]
     */
    public function loginView()
    {
        $admin = Auth::guard('admin')->user();
        if(isset($admin)){
            return redirect()->route('admin.index');
        }
        return view('admin.login');
    }

    /**
     * @return void
     */
    public function logout() 
    {
        Auth::guard('admin')->logout();

        return redirect('admin/login');
    }
}
