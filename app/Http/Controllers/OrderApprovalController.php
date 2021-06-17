<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;
use App\Models\OrderApproval;
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
    public function nocAssign(Request $request)
    {
        //dd($request->all());
        $order=OrderApproval::where('order_id',$request->id)->first();
        $order->noc_assigned_by=$request->noc_assigned_by;
        $order->noc_assigned_status="Processing";
        $order->noc_approved_status="Processing";
        $order->noc_assigned_time=now();
        $order->save();
  
        Toastr::success('Assigned Successful!.', '', ["progressbar" => true]);
        return redirect()->back();
    }
    public function workOrderApprovalMarketing($id)
    {
      $order=OrderApproval::where('order_id',$id)->first();
      $order->m_approved_status="Approved";
      $order->m_approved_time=now();
      $order->m_approved_by=Auth::guard('admin')->user()->id;
      $order->save();

      Toastr::success('Marketing Admin Approved Successful!.', '', ["progressbar" => true]);
      return redirect()->back();
    }
    public function workOrderApprovalAccount($id)
    {
      $order=OrderApproval::where('order_id',$id)->first();
      $order->a_approved_status="Approved";
      $order->a_approved_time=now();
      $order->save();

      Toastr::success('Accounts Admin Approved Successful!.', '', ["progressbar" => true]);
      return redirect()->back();
    }
    public function workOrderApprovalCOO($id)
    {
      $order=OrderApproval::where('order_id',$id)->first();
      $order->coo_approved_status="Approved";
      $order->coo_approved_time=now();
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
