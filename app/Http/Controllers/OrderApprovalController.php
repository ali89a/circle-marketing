<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;
use App\Models\OrderApproval;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Support\Facades\Auth;

class OrderApprovalController extends Controller
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
    public function workOrderApprovalNoc($id)
    {

        try {
            DB::beginTransaction();

            $order_approval = OrderApproval::where('order_id', $id)->first();
            $order_approval->noc_approved_status = "Approved";
            $order_approval->noc_approved_time = now();
            $order_approval->noc_approved_by = Auth::guard('admin')->user()->id;
            $order_approval->save();


            $order = Order::where('id', $id)->first();
            if ($order->bill_generate_method == 'by_marketing_date') {
                $mApproval = OrderApproval::where('order_id', $id)->first();
                \App\Classes\invoiceGenerate::invoice($id, $mApproval->m_approved_time);
            }
            DB::commit();
            Toastr::success('NOC Admin Approved Successful!.', '', ["progressbar" => true]);
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
    public function nocAssign(Request $request)
    {

        //dd($request->all());
        $order = OrderApproval::where('order_id', $request->id)->first();
        $order->noc_assigned_by = $request->noc_assigned_by;
        $order->noc_assigned_status = "Processing";
        $order->noc_approved_status = "Processing";
        $order->noc_assigned_time = now();
        $order->save();

        Toastr::success('Assigned Successful!.', '', ["progressbar" => true]);
        return redirect()->back();
    }
    public function workOrderApprovalMarketing($id)
    {
        $order = OrderApproval::where('order_id', $id)->first();
        $order->m_approved_status = "Approved";
        $order->m_approved_time = now();
        $order->m_approved_by = Auth::guard('admin')->user()->id;
        $order->save();

        Toastr::success('Marketing Admin Approved Successful!.', '', ["progressbar" => true]);
        return redirect()->back();
    }
    public function workOrderApprovalAccount($id)
    {
        $order = OrderApproval::where('order_id', $id)->first();
        $order->a_approved_status = "Approved";
        $order->a_approved_time = now();
        $order->save();

        Toastr::success('Accounts Admin Approved Successful!.', '', ["progressbar" => true]);
        return redirect()->back();
    }
    public function workOrderApprovalCOO($id)
    {
        $order = OrderApproval::where('order_id', $id)->first();
        $order->coo_approved_status = "Approved";
        $order->coo_approved_time = now();
        $order->save();

        Toastr::success('COO Approved Successful!.', '', ["progressbar" => true]);
        return redirect()->back();
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
     * @param  \App\Models\OrderApproval  $orderApproval
     * @return \Illuminate\Http\Response
     */
    public function show(OrderApproval $orderApproval)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\OrderApproval  $orderApproval
     * @return \Illuminate\Http\Response
     */
    public function edit(OrderApproval $orderApproval)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\OrderApproval  $orderApproval
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, OrderApproval $orderApproval)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\OrderApproval  $orderApproval
     * @return \Illuminate\Http\Response
     */
    public function destroy(OrderApproval $orderApproval)
    {
        //
    }
}
