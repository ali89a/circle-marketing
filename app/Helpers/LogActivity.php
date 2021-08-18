<?php


namespace App\Helpers;

use Request;
use Illuminate\Support\Facades\Auth;
use App\Models\LogActivity as LogActivityModel;
use App\Models\Order;

class LogActivity
{


    public static function addToLog($work_order_id)
    {

        $work_order=Order::find($work_order_id);
        $log = [];
        $log['work_order_id'] = $work_order_id;
        $log['url'] = Request::fullUrl();
        $log['ip'] = Request::ip();
        $log['admin_user_id'] = auth()->check() ? auth()->user()->id : 1;
        $log['admin_user_name'] = Auth::guard('admin')->user()->name;
        $log['old_data'] = $work_order;
        LogActivityModel::create($log);
    }


    public static function logActivityLists()
    {
        return LogActivityModel::latest()->get();
    }
}
