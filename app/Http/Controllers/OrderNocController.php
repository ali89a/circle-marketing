<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderInfo;
use App\Models\OrderNoc;
use Illuminate\Http\Request;
use App\Models\OrderApproval;
use App\Models\OrderNocItem;
use Brian2694\Toastr\Facades\Toastr;

class OrderNocController extends Controller
{
    public function nocEdit($id)
    {

        $orderNocItem = OrderNocItem::where('order_noc_id',$id)->get();

        // dd($orderNocItem);

        $order = Order::with('order_items')->where('id', $id)->first();
        $order_noc = OrderNoc::with('noc_items')->where('order_id', $id)->first();

        $customer_order_info = OrderInfo::with('order')->where('order_id', $id)->first();

        


        $data = [
            'order' => $order,
            'order_noc' => $order_noc,
            'customer_order_info' => $customer_order_info,
            // 'orderNocItem' => $orderNocItem
        ];
        return view('admin.work-order.noc_edit', $data);
    }

    public function nocUpdate(Request $request, $id)
    {

        // dd($request->all());


        $request->validate([
            'mrtg_graph_url' => 'required',
            'username' => 'required',
            'password' => 'required',
            'device_description' => 'required',

        ]);
        $noc_info = OrderNoc::with('noc_items')->where('order_id', $id)->first();

        // dd($noc_info);


        // dd($request->noc_items);
        foreach ($request->noc_items as $key => $row) {
            // dd($row);
            // $old_noc_items=OrderNocItem::where('order_noc_id',$noc_info->id)->delete();

            $result = OrderNocItem::updateOrCreate([
                                        'order_noc_id' => $id,
                                        'service_id'   => $row['service_id']
                                    ],[
                                        'vlan'                  => $row['vlan'],
                                        'ip'                    => $row['ip'],
                                        'assigned_brandwith'    => $row['assigned_brandwith']
                                    ]);
            // if(!$result->isEmpty){
               
            // }

            //                         dd($result);
          
            // $order_noc_info = new OrderNocItem();


            // $order_noc_info->order_noc_id =  $noc_info->id;
            // $order_noc_info->service_id = $row['service_id'];
            // $order_noc_info->vlan = $row['vlan'];
            // $order_noc_info->ip = $row['ip'];
            // $order_noc_info->assigned_brandwith = $row['assigned_brandwith'];
            // $order_noc_info->save();
        }

        $noc_info->mrtg_graph_url = $request->mrtg_graph_url;
        $noc_info->username = $request->username;
        $noc_info->password = $request->password;
        $noc_info->real_ip = $request->real_ip;
        $noc_info->device_description = $request->device_description;
        $noc_info->status = $request->status;
        $noc_info->save();

        $order_approval = OrderApproval::where('order_id', $id)->first();
        $order_approval->noc_processing_status = $request->status;
        $order_approval->noc_done_time = now();
        $order_approval->save();
        Toastr::success('NOC Detail Added Successful!.', '', ["progressbar" => true]);
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
     * @param  \App\Models\OrderNoc  $orderNoc
     * @return \Illuminate\Http\Response
     */
    public function show(OrderNoc $orderNoc)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\OrderNoc  $orderNoc
     * @return \Illuminate\Http\Response
     */
    public function edit(OrderNoc $orderNoc)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\OrderNoc  $orderNoc
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, OrderNoc $orderNoc)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\OrderNoc  $orderNoc
     * @return \Illuminate\Http\Response
     */
    public function destroy(OrderNoc $orderNoc)
    {
        //
    }
}
