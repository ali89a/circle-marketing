<?php

namespace App\Http\Controllers;

use App\Helpers\LogActivity;
use Illuminate\Http\Request;
use App\Models\OrderCustomerInfo;
use Brian2694\Toastr\Facades\Toastr;
use App\Models\OrderCustomerDocument;

class OrderCustomerDocumentController extends Controller
{
    public function docEdit($id)
    {
        $customer_info = OrderCustomerInfo::where('order_id', $id)->first();
        //dd($customer_info);
        if ($customer_info->organization == '' || $customer_info->client_type == '' || $customer_info->technical_email == '' || $customer_info->occupation == '' || $customer_info->billing_email == '' || $customer_info->mobile == '' || $customer_info->technical_address == '' || $customer_info->billing_address == '' || $customer_info->customer_id == '' || $customer_info->division_id == '' || $customer_info->district_id == '' || $customer_info->upazila_id == '') {
            return redirect()->back();
        } else {
            $customer_doc = OrderCustomerDocument::where('order_id', $id)->first();
            return view('admin.work-order.doc_edit', compact('customer_doc'));
        }
    }

    public function docUpdate(Request $request, $id)
    {


        $request->validate([
            'work_order' => 'mimes:jpg,jpeg,png,bmp,gif,svg,webp,pdf|max:2048',
            'authorization' => 'mimes:jpg,jpeg,png,bmp,gif,svg,webp,pdf|max:2048',
            'ip_agreement' => 'mimes:jpg,jpeg,png,bmp,gif,svg,webp,pdf|max:2048',
            'noc' => 'mimes:jpg,jpeg,png,bmp,gif,svg,webp,pdf|max:2048',
        ]);
        
        // try {
        //     DB::beginTransaction();
        $customer_doc = OrderCustomerDocument::where('order_id', $id)->first();
        if ($request->work_order != null) {
            $fileName = time() . '.' . $request->work_order->extension();
            $request->work_order->move(storage_path('app/public/work_order'), $fileName);
            $customer_doc->work_order = $fileName;
        }
        if ($request->authorization != null) {
            $fileName = time() . '.' . $request->authorization->extension();
            $request->authorization->move(storage_path('app/public/authorization'), $fileName);
            $customer_doc->authorization = $fileName;
        }
        if ($request->ip_agreement != null) {
            $fileName = time() . '.' . $request->ip_agreement->extension();
            $request->ip_agreement->move(storage_path('app/public/ip_agreement'), $fileName);
            $customer_doc->ip_agreement = $fileName;
        }
        if ($request->noc != null) {
            $fileName = time() . '.' . $request->noc->extension();
            $request->noc->move(storage_path('app/public/noc'), $fileName);
            $customer_doc->noc = $fileName;
        }
        $customer_doc->save();
        LogActivity::addToLog($id);
        // DB::commit();
        Toastr::success('Customer Doc Added Successful!.', '', ["progressbar" => true]);
        return redirect()->route('orderEdit', ['id' => $id]);
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
     * @param  \App\Models\OrderCustomerDocument  $orderCustomerDocument
     * @return \Illuminate\Http\Response
     */
    public function show(OrderCustomerDocument $orderCustomerDocument)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\OrderCustomerDocument  $orderCustomerDocument
     * @return \Illuminate\Http\Response
     */
    public function edit(OrderCustomerDocument $orderCustomerDocument)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\OrderCustomerDocument  $orderCustomerDocument
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, OrderCustomerDocument $orderCustomerDocument)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\OrderCustomerDocument  $orderCustomerDocument
     * @return \Illuminate\Http\Response
     */
    public function destroy(OrderCustomerDocument $orderCustomerDocument)
    {
        //
    }
}
