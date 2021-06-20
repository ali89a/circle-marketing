<?php


namespace App\Classes;

use Carbon\Carbon;


class PriceCalculation
{
    public static function price($unit_price, $from_date,$end_date)
    {
        
       // $to_date = Carbon::now()->endOfMonth()->toDateString();
        $to_date = $end_date;
        $to = \Carbon\Carbon::createFromFormat('Y-m-d', $to_date);
        $from = \Carbon\Carbon::createFromFormat('Y-m-d', $from_date);

        $used_days = $to->diffInDays($from);

        $total_days = date('t');
        $price = ($unit_price / $total_days) * $used_days;

        return $price;
    }
}
