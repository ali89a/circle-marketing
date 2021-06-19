<?php


namespace App\Classes;

use App\Models\Invoice;
use App\Models\InvoiceItem;
use App\Models\OrderInfo;

class invoiceGenerate
{
    public static function invoice($order_id, $from_date)
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
        $order_info = OrderInfo::where('order_id', $order_id)->first();
        $invoiceItem = new InvoiceItem();
        $invoiceItem->invoice_no = $invoice->id;
        $invoiceItem->invoice_description = 'invoice_description';
        $invoiceItem->unit_price = 'invoice_description';
        $invoiceItem->amount = 'invoice_description';
        $invoiceItem->save();
    }
}
