<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Service;
use App\Models\OrderInfo;
use App\Models\OrderItem;
use Illuminate\Http\Request;
use App\Models\OrderApproval;
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
        $request->validate([
            'downgrade_delivery_date' => 'required',
        ]);
        
        // DB::beginTransaction();
        $order = Order::find($id);
        $order->invoice_type = "Downgrate";
        $order->downgration_delivery_date = $request->downgrade_delivery_date;
        $order->bill_generate_method = $request->bill_generate_method;
        $order->save();

       
        $order_approval = OrderApproval::where('order_id', $id)->first();
        $order_approval->m_approved_status = 'Pending';
        $order_approval->a_approved_status = 'Pending';
        $order_approval->coo_approved_status = 'Pending';
        $order_approval->noc_processing_status = 'Pending';
        $order_approval->noc_approved_status = 'Pending';
        $order_approval->save();

        $services = $request->get('items');

        foreach ($services as $key => $service) {
            
            $order_item = OrderItem::where('order_id', $id)->where('service_id', $service['service_id'])->first();
            $order_item->downgration = $service['downgration'];
            $order_item->save();

            $item = new OrderDowngration();
            $item->order_id = $id;
            $item->service_id = $service['service_id'];
            $item->capacity = $service['capacity'];
            $item->downgration = $service['downgration'];
            $item->price = $service['price'];
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
