<?php


namespace App\Classes;

use Carbon\Carbon;
use App\Models\Order;
use App\Models\Invoice;
use App\Models\OrderItem;
use App\Models\InvoiceItem;

class upgrateInvoiceGenerate
{
    public static function invoice($order_id, $from_date,$end_date)
    {
        $order = Order::find($order_id);
        $last_invoice = Invoice::where('order_id',$order_id)->latest()->first();
        $invoice = Invoice::create([
            'order_id' => $order_id,
            'invoice_no' => \App\Classes\InvoiceNumber::serial_number(),
            'link_id' =>  $order->link_id,
            'invoice_date' => now(),
            'billing_address' => $order->customer_details->billing_address,
            'subject' => 'New Installation Bill Month Of '.now()->format('M').'-'.Carbon::now()->year,
            'status' => 'New',
            'previous_due' => 0,
            'core_rent' => $order->core_rent,
            'otc' => $order->otc,
        ]);
        $order_infos = OrderItem::where('order_id', $order_id)->get();
        foreach ($order_infos as $order_info) {

            $invoiceItem = new InvoiceItem();
            $invoiceItem->invoice_id = $invoice->id;
            $invoiceItem->invoice_description = $order_info->service->name.' '.'('.$order_info->capacity.')('.$from_date.' to '.$end_date.')';
            $invoiceItem->unit_price = $order_info->price;
            $invoiceItem->order_id = $order_info->order_id;
            $invoiceItem->service_id = $order_info->service_id;
            $invoiceItem->amount = \App\Classes\PriceCalculation::price($order_info->price,$from_date,$end_date);
            $invoiceItem->save();
        }
    }
}
