<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
class AdminController extends Controller
{
    /**
     * @return View
     */
    public function index() : View
    {  // $countProduct = $this->get('countProduct');
        $admin = Auth::guard('admin')->user();

        return view('admin.adminLayout', ['user'=>$admin]);
    }
    
    /**
     * @return View
     */
    public function onlyfan() : View
    {
        return view('admin.pages.maincontent');
    }

    /**
     * @return View
     */
    public function viewProfile() : View
    {
        return view('admin.user.admin-profile');
    }
}
