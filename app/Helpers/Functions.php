<?php

use App\Models\OrderApproval;
use Illuminate\Support\Facades\Auth;

function use_days($from_date, $end_date)
{
    $to = \Carbon\Carbon::createFromFormat('Y-m-d', $end_date);
    $from = \Carbon\Carbon::createFromFormat('Y-m-d', $from_date);
    $used_days = $to->diffInDays($from);

    return $used_days + 1;
}

function total_used_price($capacity, $unit_price, $used_days)
{
    $total_days = date('t');
    $price = (($capacity * $unit_price) / $total_days) * $used_days;

    return $price;
}
function marketingAutoApproval($orderId)
{
    $order = OrderApproval::where('order_id', $orderId)->first();
    $order->m_approved_status = "Approved";
    $order->m_approved_time = now();
    $order->m_approved_by = 0;
    $order->save();
}
