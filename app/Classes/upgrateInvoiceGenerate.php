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

        foreach ($order_items as $order_item) {

            foreach ($last_invoice->items as $last_invoice_item) {
                if ($order_item->service_id ==  $last_invoice_item->service_id) {


                    if ($order_item->capacity > $last_invoice_item->capacity) {


                        //Create updated item for new invoice
                        $invoiceItem = new InvoiceItem();
                        $invoiceItem->invoice_id = $invoice->id;
                        $invoiceItem->invoice_description = 'test';
                        $invoiceItem->from_date = $from_date;
                        $invoiceItem->to_date = $end_date;
                        $invoiceItem->used_total_days = use_days($from_date, $end_date) + 1;
                        $invoiceItem->unit_price = $order_item->price;
                        $invoiceItem->capacity = $order_item->capacity;
                        $invoiceItem->per_day_price = ($order_item->price / date('t'));
                        $invoiceItem->order_id = $order_item->order_id;
                        $invoiceItem->service_id = $order_item->service_id;
                        $invoiceItem->amount = total_used_price($order_item->price, use_days($from_date, $end_date) + 1);
                        $invoiceItem->save();

                        //Update old invoice item

                        $old_invoiceItem = new InvoiceItem();
                        $old_invoiceItem->invoice_id = $invoice->id;
                        $old_invoiceItem->invoice_description = 'old_rem';
                        $old_invoiceItem->from_date = $last_invoice_item->from_date;
                        $old_invoiceItem->to_date = date("Y-m-d", strtotime("-1 day", strtotime($from_date)));
                        $old_invoiceItem->used_total_days = use_days($old_invoiceItem->to_date, $last_invoice_item->from_date) + 1;
                        $old_invoiceItem->unit_price = $last_invoice_item->unit_price;
                        $old_invoiceItem->capacity = $last_invoice_item->capacity;
                        $old_invoiceItem->per_day_price = $last_invoice_item->per_day_price;
                        $old_invoiceItem->order_id = $last_invoice_item->order_id;
                        $old_invoiceItem->service_id = $last_invoice_item->service_id;
                        $old_invoiceItem->amount =  total_used_price($order_item->price, use_days($old_invoiceItem->to_date, $last_invoice_item->from_date) + 1);
                        $old_invoiceItem->save();
                    } else {

                        $invoiceItem = new InvoiceItem();
                        $invoiceItem->invoice_id = $invoice->id;
                        $invoiceItem->invoice_description = 'tsest';
                        $invoiceItem->from_date = $last_invoice_item->from_date;
                        $invoiceItem->to_date = $last_invoice_item->to_date;
                        $invoiceItem->used_total_days = $last_invoice_item->used_total_days;
                        $invoiceItem->unit_price = $last_invoice_item->unit_price;
                        $invoiceItem->capacity = $last_invoice_item->capacity;
                        $invoiceItem->per_day_price = $last_invoice_item->per_day_price;
                        $invoiceItem->order_id = $last_invoice_item->order_id;
                        $invoiceItem->service_id = $last_invoice_item->service_id;
                        $invoiceItem->amount = $last_invoice_item->amount;
                        $invoiceItem->save();
                    }
                }
            }
        }
    }
}
