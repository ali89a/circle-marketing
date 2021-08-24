<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Admin\Admin;
use App\Models\Order;
use App\Models\OrderApproval;

class HomeController extends Controller
{
    function __construct()
    {
        $this->middleware('permission:dashboard', ['only' => ['index']]);
    }
    public function index()
    {
        $data = [
            'marketing_users' => Admin::role(['Marketing Executive', 'Marketing Admin'])->get(),
            'm_pending' => Order::whereHas('order_approval', function ($q) {
                $q->where('m_approved_status', 'Pending');
            })->count(),
            'users' => Admin::count(),
        ];

        return view('admin.home.home', $data);
    }
}
