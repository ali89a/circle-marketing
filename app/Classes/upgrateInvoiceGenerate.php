<?php


namespace App\Classes;

use Carbon\Carbon;
use App\Models\Order;
use App\Models\Invoice;
use App\Models\OrderItem;
use App\Models\InvoiceItem;

class upgrateInvoiceGenerate
{
    public static function invoice($order_id, $from_date, $end_date)
    {


        $order = Order::find($order_id);
        $last_invoice = Invoice::where('order_id', $order_id)->latest()->first();
        $invoice = Invoice::create([
            'order_id' => $order_id,
            'invoice_no' => \App\Classes\InvoiceNumber::serial_number(),
            'link_id' =>  $order->link_id,
            'invoice_date' => now(),
            'billing_address' => $order->customer_details->billing_address,
            'subject' => 'New Installation Bill Month Of ' . now()->format('M') . '-' . Carbon::now()->year,
            'status' => 'New',
            'previous_due' => 0,
            'core_rent' => $order->core_rent,
            'otc' => $order->otc,
        ]);
        $order_items = OrderItem::where('order_id', $order_id)->get();
        $up_invoice_items = [];
        foreach ($order_items as $order_item) {

            foreach ($last_invoice->items as $invoice_item) {
                if ($order_item->capacity > $invoice_item->capacity) {

                }
            }
        }
    }
}
