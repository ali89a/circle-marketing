<?php

namespace App\Http\Controllers;

use App\Models\Service;
use App\Models\OrderInfo;
use App\Models\OrderItem;
use Illuminate\Http\Request;
use App\Models\OrderUpgration;
use Brian2694\Toastr\Facades\Toastr;

class OrderUpgrationController extends Controller
{
    public function orderUpgration($id)
    {
        $all_service = Service::all();
        $customer_order_info = OrderInfo::with('order')->where('order_id', $id)->first();
        return view('admin.work-order.upgration', compact('customer_order_info', 'all_service'));
    }
    public function orderUpgrationUpdate(Request $request, $id)
    {
        //dd($request->all());
        // DB::beginTransaction();

        $products = $request->get('items');

        foreach ($products as $key => $product) {
            $order_item = OrderItem::where('order_id', $id)->where('service_id', $product['service_id'])->first();
            $order_item->upgration = $product['upgration'];
            $order_item->save();

            $item = new OrderUpgration();
            $item->order_id = $id;
            $item->service_id = $product['service_id'];
            $item->capacity = $product['capacity'];
            $item->upgration = $product['upgration'];
            $item->price = $product['price'];
            $item->status = "Pending";
            $item->save();
        }
        //  DB::commit();
        Toastr::success('Order Upgration Added Successful!.', '', ["progressbar" => true]);
        return redirect()->route('work-order.index');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
     * @param  \App\Models\OrderUpgration  $orderUpgration
     * @return \Illuminate\Http\Response
     */
    public function show(OrderUpgration $orderUpgration)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\OrderUpgration  $orderUpgration
     * @return \Illuminate\Http\Response
     */
    public function edit(OrderUpgration $orderUpgration)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\OrderUpgration  $orderUpgration
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, OrderUpgration $orderUpgration)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\OrderUpgration  $orderUpgration
     * @return \Illuminate\Http\Response
     */
    public function destroy(OrderUpgration $orderUpgration)
    {
        //
    }
}
