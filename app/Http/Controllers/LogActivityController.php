<?php

namespace App\Http\Controllers;

use App\Models\LogActivity;
use Illuminate\Http\Request;

class LogActivityController extends Controller
{
    public function workOrderLogActivity($id)
    {
        $olds=LogActivity::where('work_order_id',$id)->get();
        foreach($olds as $old){
            echo '<pre>';
            print_r(json_decode($old));
            print_r(json_decode($old['old_data']));
            echo '</pre>';
        }
    }
}
