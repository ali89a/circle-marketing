<?php


namespace App\Helpers;

use Request;
use Illuminate\Support\Facades\Auth;
use App\Models\LogActivity as LogActivityModel;


class LogActivity
{


    public static function addToLog($subject = NULL, $new = NULL, $old = NULL)
    {
        $log = [];
        $log['subject'] = $subject;
        $log['new_data'] = json_encode($new);
        $log['old_data'] = json_encode($old);
        $log['url'] = Request::fullUrl();
        $log['method'] = Request::method();
        $log['ip'] = Request::ip();
        $log['agent'] = Request::header('user-agent');
        $log['admin_user_id'] = auth()->check() ? auth()->user()->id : 1;
        $log['user_name'] = Auth::guard('admin')->user()->name;
        LogActivityModel::create($log);
    }


    public static function logActivityLists()
    {
        return LogActivityModel::latest()->get();
    }
}
