<?php


namespace App\Classes;

use Carbon\Carbon;
use App\Models\Order;
use App\Models\Invoice;
use App\Models\OrderItem;
use App\Models\InvoiceItem;
use App\Models\InvoiceApproval;

class downgrateInvoiceGenerate
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
            'subject' => 'New Downgration Bill Month Of ' . now()->format('M') . '-' . Carbon::now()->year,
            'status' => 'Downgration',
            'previous_due' => 0,
            'real_ip' => $order->real_ip,
            'core_rent' => $order->core_rent,
            'otc' => $order->otc,
        ]);
        $order_items = OrderItem::where('order_id', $order_id)->get();

        foreach ($order_items as $order_item) {

            foreach ($last_invoice->items as $last_invoice_item) {
                if ($order_item->service_id ==  $last_invoice_item->service_id) {


                    if ($order_item->capacity < $last_invoice_item->capacity) {
                        //Update old invoice item

                        $old_invoiceItem = new InvoiceItem();
                        $old_invoiceItem->invoice_id = $invoice->id;
                        $old_invoiceItem->invoice_description = $order_item->service->name . ' ' . '(' . $last_invoice_item->capacity . ')(' . $last_invoice_item->from_date . ' to ' . $from_date . ')';
                        $old_invoiceItem->from_date = $last_invoice_item->from_date;
                        $old_invoiceItem->to_date = $from_date;
                        $old_invoiceItem->used_total_days = use_days($last_invoice_item->from_date, $from_date);
                        $old_invoiceItem->unit_price = $last_invoice_item->unit_price;
                        $old_invoiceItem->capacity = $last_invoice_item->capacity;
                        $old_invoiceItem->per_day_price = $last_invoice_item->per_day_price;
                        $old_invoiceItem->order_id = $last_invoice_item->order_id;
                        $old_invoiceItem->service_id = $last_invoice_item->service_id;
                        $old_invoiceItem->amount =  $last_invoice_item->per_day_price * use_days($last_invoice_item->from_date, $from_date);
                        $old_invoiceItem->save();

                        //Create updated item for new invoice
                        $invoiceItem = new InvoiceItem();
                        $invoiceItem->invoice_id = $invoice->id;
                        $invoiceItem->invoice_description = $order_item->service->name . ' ' . '(' . $order_item->capacity . ')(' . $from_date . ' to ' . $end_date . ')';
                        $invoiceItem->from_date = $from_date;
                        $invoiceItem->to_date = $end_date;
                        $invoiceItem->used_total_days = use_days($from_date, $end_date);
                        $invoiceItem->unit_price = $order_item->price;
                        $invoiceItem->capacity = $order_item->capacity;
                        $invoiceItem->per_day_price = ($order_item->price / date('t'));
                        $invoiceItem->order_id = $order_item->order_id;
                        $invoiceItem->service_id = $order_item->service_id;
                        $invoiceItem->amount = total_used_price($order_item->capacity, $order_item->price, use_days($from_date, $end_date) + 1);
                        $invoiceItem->save();
                    } else {

                        $invoiceItem = new InvoiceItem();
                        $invoiceItem->invoice_id = $invoice->id;
                        $invoiceItem->invoice_description = $last_invoice_item->invoice_description;
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
                    $invoice_approval = new InvoiceApproval();
                    $invoice_approval->noc_approved_status = 'Pending';
                    $invoice_approval->m_approved_status = 'Pending';
                    $invoice_approval->a_approved_status = 'Pending';
                    $invoice_approval->coo_approved_status = 'Pending';
                    $invoice_approval->order_id = $order->id;
                    $invoice_approval->invoice_id = $invoice->id;
                    $invoice_approval->save();
                }
            }
        }
    }
}
