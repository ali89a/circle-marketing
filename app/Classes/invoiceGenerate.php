<?php


namespace App\Classes;

use App\Models\Invoice;
use App\Models\InvoiceItem;
use App\Models\OrderItem;

class invoiceGenerate
{
    public static function invoice($order_id, $from_date,$end_date)
    {
        $invoice = Invoice::create([
            'order_id' => $order_id,
            'invoice_no' => \App\Classes\InvoiceNumber::serial_number(),
            'link_id' => 1,
            'invoice_date' => now(),
            'billing_address' => 'Paratoly',
            'subject' => 'Paratoly',
            'previous_due' => 20000,
        ]);
        $order_infos = OrderItem::where('order_id', $order_id)->get();
        foreach ($order_infos as $order_info) {

            $invoiceItem = new InvoiceItem();
            $invoiceItem->invoice_id = $invoice->id;
            $invoiceItem->invoice_description = $order_info->service->name.' '.'('.$order_info->capacity.')('.$from_date.' to '.$end_date.')';
            $invoiceItem->unit_price = $order_info->price;
            $invoiceItem->amount = \App\Classes\PriceCalculation::price($order_info->price,$from_date,$end_date);
            $invoiceItem->save();
        }
    }
}
