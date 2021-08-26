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
        $order = Order::with('customer_details', 'order_approval')->where('id', $work_order_id)->first();

        $old_data = [
            'order' => $order,
            'order_items' => $order->order_items,
            'upgrations' => $order->upgrations,
            'downgrations' => $order->downgrations,
            'customer' => $order->customer,
            'noc' => $order,
        ];

        $log = [];
        $log['work_order_id'] = $order->id;
        $log['url'] = Request::fullUrl();
        $log['ip'] = Request::ip();
        $log['admin_user_id'] = auth()->check() ? auth()->user()->id : 1;
        $log['admin_user_name'] = Auth::guard('admin')->user()->name ?? '';
        $log['old_data'] =  json_encode($old_data);
        LogActivityModel::create($log);
    }


    public static function logActivityLists()
    {
        return LogActivityModel::latest()->get();
    }
}
