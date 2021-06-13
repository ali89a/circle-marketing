<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderCustomerDocument;
use App\Models\OrderCustomerInfo;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.work-order.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.work-order.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $order = new Order();
        $order->save();

        $customer_doc = new OrderCustomerDocument();
        $customer_doc->order_id = $order->id;
        $customer_doc->save();
        

        $customer_info = new OrderCustomerInfo();
        $customer_info->organization = $request->organization;
        $customer_info->client_type = $request->client_type;
        $customer_info->occupation = $request->occupation;
        $customer_info->technical_email = $request->technical_email;
        $customer_info->billing_email = $request->billing_email;
        $customer_info->mobile = $request->mobile;
        $customer_info->alter_mobile = $request->alter_mobile;
        $customer_info->customer_id = $request->customer_id;
        $customer_info->division_id = $request->division_id;
        $customer_info->district_id = $request->district_id;
        $customer_info->upazila_id = $request->upazila_id;
        $customer_info->order_id = $order->id;
        $customer_info->save();

        return redirect()->back();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function show(Order $order)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function edit(Order $order)
    {
        return view('admin.work-order.edit');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Order $order)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function destroy(Order $order)
    {
        //
    }
}
