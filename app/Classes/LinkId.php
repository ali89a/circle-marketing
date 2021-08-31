<?php

namespace App\Classes;

use App\Models\Order;

class LinkId
{
    public static function serial_number()
    {
        $serial = self::count_last_serial_for_training();
        return $serial_number = date('Y') . date('m') .'_'. str_pad($serial, 3, '0', STR_PAD_LEFT);
    }
    private static function count_last_serial_for_training()
    {
        return Order::whereYear('created_at', date('Y'))
            ->whereMonth('created_at', date('m'))
            ->count();

    }
}
