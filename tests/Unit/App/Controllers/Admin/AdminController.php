<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
class AdminController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
            // $countProduct = $this->get('countProduct');
            $admin = Auth::guard('admin')->user();
            return view('admin.adminLayout',['user'=>$admin]);
    }
    public function onlyfan(){
        return view('admin.pages.maincontent');
    }
    public function viewProfile(){
        return view('admin.user.admin-profile');
    }
}
