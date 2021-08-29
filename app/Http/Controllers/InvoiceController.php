<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Order;
use App\Models\Invoice;
use App\Models\OrderItem;
use App\Models\InvoiceItem;
use Illuminate\Http\Request;
use App\Models\InvoiceApproval;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Brian2694\Toastr\Facades\Toastr;
use niklasravnsborg\LaravelPdf\Facades\Pdf;

class InvoiceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }
    public function monthlyInvoiceGenerate()
    {
        $orders = Order::where('status', 'Active')->get();
        if (count($orders) > 0) {
            foreach ($orders as $key => $order) {
                $from_date = \Carbon\Carbon::now()->startOfMonth()->toDateString();
                $end_date = \Carbon\Carbon::now()->endOfMonth()->toDateString();

                try {
                    DB::beginTransaction();
                    $invoice = Invoice::create([
                        'order_id' => $order->id,
                        'invoice_no' => \App\Classes\InvoiceNumber::serial_number(),
                        'link_id' =>  $order->link_id,
                        'invoice_date' => now(),
                        'billing_address' => $order->customer_details->billing_address,
                        'subject' => 'Monthly Bill Month Of ' . now()->format('M') . '-' . Carbon::now()->year,
                        'status' => 'New',
                        'previous_due' => 0,
                        'real_ip' => $order->real_ip,
                        'core_rent' => $order->core_rent,
                        'otc' => $order->otc,
                        'vat' => $order->vat,
                    ]);
                    $order_infos = OrderItem::where('order_id', $order->id)->get();
                    foreach ($order_infos as $order_info) {

                        $invoiceItem = new InvoiceItem();
                        $invoiceItem->invoice_id = $invoice->id;
                        $invoiceItem->invoice_description = $order_info->service->name . ' ' . '(' . $order_info->capacity . ')(' . $from_date . ' to ' . $end_date . ')';
                        $invoiceItem->from_date = $from_date;
                        $invoiceItem->to_date = $end_date;
                        $invoiceItem->used_total_days = use_days($from_date, $end_date);
                        $invoiceItem->unit_price = $order_info->price;
                        $invoiceItem->capacity = $order_info->capacity;
                        $invoiceItem->per_day_price = ($order_info->capacity * $order_info->price) / date('t');
                        $invoiceItem->order_id = $order_info->order_id;
                        $invoiceItem->service_id = $order_info->service_id;
                        $invoiceItem->amount = total_used_price($order_info->capacity, $order_info->price, use_days($from_date, $end_date));
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
                    DB::commit();
                    Toastr::success('Monthly Invoice Generate Successful!.', '', ["progressbar" => true]);
                    return redirect()->back();
                } catch (\Exception $e) {
                    DB::rollBack();
                    Log::emergency("File:" . $e->getFile() . "Line:" . $e->getLine() . "Message:" . $e->getMessage());
                    $output = [
                        'success' => 0,
                        'msg' => __("messages.something_went_wrong")
                    ];
                    Toastr::info('Something went wrong!.', '', ["progressbar" => true]);
                    return back();
                }
            }
        } else {
            Toastr::warning('Order Not Found!.', '', ["progressBar" => true]);
            return redirect()->back();
        }
    }
    public function monthlyInvoice()
    {
        return view('admin.work-order.monthly_invoice');
    }
    public function invoices($id)
    {
        $invoices = Invoice::where('order_id', $id)->get();
        return view('admin.work-order.invoice', compact('invoices'));
    }
    public function invoiceDetails($inv_id)
    {
        $invoice = Invoice::with('items')->where('id', $inv_id)->first();

        return view('admin.work-order.invoice_details', compact('invoice'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Invoice  $invoice
     * @return \Illuminate\Http\Response
     */
    public function show(Invoice $invoice)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Invoice  $invoice
     * @return \Illuminate\Http\Response
     */
    public function edit(Invoice $invoice)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Invoice  $invoice
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Invoice $invoice)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Invoice  $invoice
     * @return \Illuminate\Http\Response
     */
    public function destroy(Invoice $invoice)
    {
        //
    }
    public function pdf($id)
    {
        $data = [
            'invoice' => Invoice::find($id),

        ];

        $pdf = PDF::loadView(
            'admin.work-order.pdf',
            $data,
            [],
            [
                'format' => 'A4-P',
                'orientation' => 'P',
                'margin-left' => 1,

                '', // mode - default ''
                '', // format - A4, for example, default ''
                0, // font size - default 0
                '', // default font family
                1, // margin_left
                1, // margin right
                1, // margin top
                1, // margin bottom
                1, // margin header
                1, // margin footer
                'L', // L - landscape, P - portrait

            ]
        );
        $name = \Carbon\Carbon::now()->format('d-m-Y');

        return $pdf->stream($name . '.pdf');
    }
    public function pdfDownload($id)
    {
        $data = [
            'invoice' => Invoice::find($id),

        ];

        $pdf = PDF::loadView(
            'admin.work-order.pdf',
            $data,
            [],
            [
                'format' => 'A4-P',
                'orientation' => 'P',
                'margin-left' => 1,

                '', // mode - default ''
                '', // format - A4, for example, default ''
                0, // font size - default 0
                '', // default font family
                1, // margin_left
                1, // margin right
                1, // margin top
                1, // margin bottom
                1, // margin header
                1, // margin footer
                'L', // L - landscape, P - portrait

            ]
        );
        $name = \Carbon\Carbon::now()->format('d-m-Y');

        return $pdf->download($name . '.pdf');
    }
}
