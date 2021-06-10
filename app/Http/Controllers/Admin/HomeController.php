<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Admin\Admin;

class HomeController extends Controller
{
    public function index()
    {
        $users = Admin::count();
    
        return view('admin.home.home',compact('users'));
    }
}
