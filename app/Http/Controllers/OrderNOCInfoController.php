<?php

namespace App\Http\Controllers;

use App\Models\OrderNOCInfo;
use Illuminate\Http\Request;
use App\Models\OrderApproval;
use Brian2694\Toastr\Facades\Toastr;

class OrderNOCInfoController extends Controller
{
    public function nocEdit($id)
    {
        $data = [
            'order_noc' => OrderNOCInfo::where('order_id', $id)->first()
        ];
        return view('admin.work-order.noc_edit', $data);
    }
    public function nocUpdate(Request $request, $id)
    {
        $request->validate([
            'mrtg_graph_url' => 'required',
            'username' => 'required',
            'password' => 'required',
            'device_description' => 'required',

        ]);
        $noc_info = OrderNOCInfo::where('order_id', $id)->first();
        $noc_info->vlan_internet = $request->vlan_internet;
        $noc_info->vlan_ggc = $request->vlan_internet;
        $noc_info->vlan_fb = $request->vlan_internet;
        $noc_info->vlan_bdix = $request->vlan_internet;
        $noc_info->vlan_data = $request->vlan_internet;

        $noc_info->ip_internet = $request->ip_internet;
        $noc_info->ip_ggc = $request->ip_internet;
        $noc_info->ip_fb = $request->ip_internet;
        $noc_info->ip_bdix = $request->ip_internet;
        $noc_info->ip_data = $request->ip_internet;

        $noc_info->assigned_bandwidth_internet = $request->assigned_bandwidth_internet;
        $noc_info->assigned_bandwidth_ggc = $request->assigned_bandwidth_internet;
        $noc_info->assigned_bandwidth_fb = $request->assigned_bandwidth_internet;
        $noc_info->assigned_bandwidth_bdix = $request->assigned_bandwidth_internet;
        $noc_info->assigned_bandwidth_data = $request->assigned_bandwidth_internet;

        $noc_info->mrtg_graph_url = $request->mrtg_graph_url;
        $noc_info->username = $request->username;
        $noc_info->password = $request->password;
        $noc_info->real_ip = $request->real_ip;
        $noc_info->device_description = $request->device_description;
        $noc_info->status = 'done';
        $noc_info->save();

        $order_approval = OrderApproval::where('order_id', $id)->first();
        $order_approval->noc_assigned_status = "done";
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
     * @param  \App\Models\OrderNOCInfo  $orderNOCInfo
     * @return \Illuminate\Http\Response
     */
    public function show(OrderNOCInfo $orderNOCInfo)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\OrderNOCInfo  $orderNOCInfo
     * @return \Illuminate\Http\Response
     */
    public function edit(OrderNOCInfo $orderNOCInfo)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\OrderNOCInfo  $orderNOCInfo
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, OrderNOCInfo $orderNOCInfo)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\OrderNOCInfo  $orderNOCInfo
     * @return \Illuminate\Http\Response
     */
    public function destroy(OrderNOCInfo $orderNOCInfo)
    {
        //
    }
}
