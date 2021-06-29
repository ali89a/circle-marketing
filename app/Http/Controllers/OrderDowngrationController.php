<?php

namespace App\Http\Controllers;

use App\Models\Service;
use App\Models\OrderInfo;
use Illuminate\Http\Request;
use App\Models\OrderDowngration;
use Brian2694\Toastr\Facades\Toastr;

class OrderDowngrationController extends Controller
{


    public function orderDowngration($id)
    {
        $all_service = Service::all();
        $customer_order_info = OrderInfo::with('order')->where('order_id', $id)->first();
        return view('admin.work-order.downgration', compact('customer_order_info', 'all_service'));
    }
  
    public function orderDowngrationUpdate(Request $request, $id)
    {
        // DB::beginTransaction();

        $products = $request->get('items');

        foreach ($products as $key => $product) {
            $item = new OrderDowngration();
            $item->order_id = $id;
            $item->service_id = $product['service_id'];
            $item->capacity = $product['capacity'];
            $item->downgration = $product['downgration'];
            $item->price = $product['price'];
            $item->status = "Pending";
            $item->save();
        }
        //  DB::commit();
        Toastr::success('Order Downgration Added Successful!.', '', ["progressbar" => true]);
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
     * @param  \App\Models\OrderDowngration  $orderDowngration
     * @return \Illuminate\Http\Response
     */
    public function show(OrderDowngration $orderDowngration)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\OrderDowngration  $orderDowngration
     * @return \Illuminate\Http\Response
     */
    public function edit(OrderDowngration $orderDowngration)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\OrderDowngration  $orderDowngration
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, OrderDowngration $orderDowngration)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\OrderDowngration  $orderDowngration
     * @return \Illuminate\Http\Response
     */
    public function destroy(OrderDowngration $orderDowngration)
    {
        //
    }
}
