<?php

namespace App\Http\Controllers;

use App\Models\Upazila;
use App\Models\District;
use App\Models\Division;
use App\Helpers\LogActivity;
use Illuminate\Http\Request;
use App\Models\OrderCustomerInfo;
use Brian2694\Toastr\Facades\Toastr;

class OrderCustomerInfoController extends Controller
{

    public function customerDetailEdit($id)
    {
        $data = [
            'divisions' => Division::all(),
            'order_customer_info' => OrderCustomerInfo::where('order_id', $id)->first()
        ];
        return view('admin.work-order.customer_detail_edit', $data);
    }
    public function customerDetailUpdate(Request $request, $id)
    {

        // try {
        //     DB::beginTransaction();

        $customer_info = OrderCustomerInfo::where('order_id', $id)->first();
        $customer_info->organization = $request->organization;
        $customer_info->client_type = $request->client_type;
        $customer_info->occupation = $request->occupation;
        $customer_info->technical_email = $request->technical_email;
        $customer_info->billing_email = $request->billing_email;
        $customer_info->technical_address = $request->technical_address;
        $customer_info->billing_address = $request->billing_address;
        $customer_info->mobile = $request->mobile;
        $customer_info->alter_mobile = $request->alter_mobile;
        $customer_info->customer_id = $request->customer_id;
        $customer_info->division_id = $request->division_id;
        $customer_info->district_id = $request->district_id;
        $customer_info->upazila_id = $request->upazila_id;
        $customer_info->save();
        LogActivity::addToLog($id);
        //  DB::commit();
        Toastr::success('Customer Info Added Successful!.', '', ["progressbar" => true]);
        return redirect()->route('docEdit', ['id' => $id]);
        // } catch (\Exception $e) {
        //     DB::rollBack();
        //     Log::emergency("File:" . $e->getFile() . "Line:" . $e->getLine() . "Message:" . $e->getMessage());
        //     $output = [
        //         'success' => 0,
        //         'msg' => __("messages.something_went_wrong")
        //     ];
        //     Toastr::info('Something went wrong!.', '', ["progressbar" => true]);
        //     return back();
        // }
    }

    public function fetch_district($id)
    {

        $data = [
            'districts' => District::where('division_id', $id)->orderBy('name', 'ASC')->get()
        ];

        return $data;
    }
    public function fetch_upazila($id)
    {

        $data = [
            'upazilas' => Upazila::where('district_id', $id)->orderBy('name', 'ASC')->get()
        ];

        return $data;
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
     * @param  \App\Models\OrderCustomerInfo  $orderCustomerInfo
     * @return \Illuminate\Http\Response
     */
    public function show(OrderCustomerInfo $orderCustomerInfo)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\OrderCustomerInfo  $orderCustomerInfo
     * @return \Illuminate\Http\Response
     */
    public function edit(OrderCustomerInfo $orderCustomerInfo)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\OrderCustomerInfo  $orderCustomerInfo
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, OrderCustomerInfo $orderCustomerInfo)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\OrderCustomerInfo  $orderCustomerInfo
     * @return \Illuminate\Http\Response
     */
    public function destroy(OrderCustomerInfo $orderCustomerInfo)
    {
        //
    }
}
