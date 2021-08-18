<?php

function use_days($from_date, $end_date)
{
    $to = \Carbon\Carbon::createFromFormat('Y-m-d', $end_date);
    $from = \Carbon\Carbon::createFromFormat('Y-m-d', $from_date);
    $used_days = $to->diffInDays($from);

    return $used_days;
}
function total_used_price($capacity, $unit_price, $used_days)
{
    $total_days = date('t');
    $price = (($capacity * $unit_price) / $total_days) * $used_days;

    return $price;
}
