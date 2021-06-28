<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Admin\Admin;
use App\Models\Order;
use App\Models\OrderApproval;

class HomeController extends Controller
{
    public function index()
    {
        $data=[
            'marketing_users' => Admin::role(['Marketing Executive', 'Marketing Admin'])->get(),
            'users'=>Admin::count(),
        ];
    
        return view('admin.home.home',$data);
    }
}
