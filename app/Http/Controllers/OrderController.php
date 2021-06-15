<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Upazila;
use App\Models\District;
use App\Models\Division;
use App\Models\OrderInfo;
use App\Models\OrderBuffer;
use App\Models\OrderNOCInfo;
use Illuminate\Http\Request;
use App\Models\OrderCustomerInfo;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Brian2694\Toastr\Facades\Toastr;
use App\Models\OrderCustomerDocument;
use App\Models\User;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data=[
            'orders'=>Order::with('customer_details')->get(),
        ];
        return view('admin.work-order.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data=[
            'divisions'=>Division::all(),
            'customers'=>User::all(),
        ];
        return view('admin.work-order.create',$data);
    }
    public function docEdit($id)
    {
        $customer_doc = OrderCustomerDocument::where('order_id', $id)->first();
        return view('admin.work-order.doc_edit', compact('customer_doc'));
    }

    public function docUpdate(Request $request, $id)
    {
        try {
            DB::beginTransaction();
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
            DB::commit();
            Toastr::success('Customer Doc Added Successful!.', '', ["progressbar" => true]);
            return redirect()->route('orderEdit', ['id' => $id]);
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
    public function orderEdit($id)
    {
        $customer_order = Order::where('id', $id)->first();
        return view('admin.work-order.order_edit', compact('customer_order'));
    }
    public function orderDetailEdit($id)
    {
        $customer_order_info = OrderInfo::where('order_id', $id)->first();
        return view('admin.work-order.order_detail_edit', compact('customer_order_info'));
    }
    public function customerDetailEdit($id)
    {
        $data=[
            'divisions'=>Division::all(),
            'order_customer_info'=>OrderCustomerInfo::where('order_id', $id)->first()
        ];
        return view('admin.work-order.customer_detail_edit', $data);
    }
    public function customerDetailUpdate(Request $request,$id)
    {
        
        try {
            DB::beginTransaction();

            $customer_info =OrderCustomerInfo::where('order_id',$id)->first();
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
            DB::commit();
            Toastr::success('Customer Info Added Successful!.', '', ["progressbar" => true]);
            return redirect()->route('docEdit', ['id' => $id]);
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
    public function orderDetailUpdate(Request $request, $id)
    {
        try {
            DB::beginTransaction();
            $order_info = OrderInfo::where('order_id', $id)->first();
            $order_info->internet_capacity_1 = $request->internet_capacity_1;
            $order_info->internet_price_1 = $request->internet_price_1;
            $order_info->bdix_capacity_1 = $request->bdix_capacity_1;
            $order_info->bdix_price_1 = $request->bdix_price_1;
            $order_info->youtube_capacity_1 = $request->youtube_capacity_1;
            $order_info->youtube_price_1 = $request->youtube_price_1;
            $order_info->facebook_capacity_1 = $request->facebook_capacity_1;
            $order_info->facebook_price_1 = $request->facebook_price_1;
            $order_info->data_capacity_1 = $request->data_capacity_1;
            $order_info->data_price_1 = $request->data_price_1;
            $order_info->save();
            DB::commit();
            Toastr::success('Order Detail Added Successful!.', '', ["progressbar" => true]);
            return redirect()->route('work-order.index');
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

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        try {
            DB::beginTransaction();
            $order = new Order();
            $order->customer_id = $request->customer_id;
            $order->save();

            $order_info = new OrderInfo();
            $order_info->order_id = $order->id;
            $order_info->save();

            $order_buffer = new OrderBuffer();
            $order_buffer->order_id = $order->id;
            $order_buffer->save();

            $order_noc = new OrderNOCInfo();
            $order_noc->order_id = $order->id;
            $order_noc->save();

            $customer_doc = new OrderCustomerDocument();
            $customer_doc->order_id = $order->id;
            $customer_doc->save();


            $customer_info = new OrderCustomerInfo();
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
            $customer_info->order_id = $order->id;
            $customer_info->save();
            DB::commit();
            Toastr::success('Customer Info Added Successful!.', '', ["progressbar" => true]);
            return redirect()->route('docEdit', ['id' => $order->id]);
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
    public function update(Request $request, $id)
    {
        try {
            DB::beginTransaction();
            $order = Order::where('id', $id)->first();
            $order->type = $request->type;
            $order->scl_id = $request->scl_id;
            $order->gmap_location = $request->gmap_location;
            $order->link_id = $request->link_id;
            $order->vat = $request->vat;
            $order->order_submission_date = $request->order_submission_date;
            $order->billing_cycle = $request->billing_cycle;
            $order->billing_remark = $request->billing_remark;
            $order->bill_start_date = $request->bill_start_date;
            $order->delivery_date = $request->delivery_date;
            $order->bill_generate_method = $request->bill_generate_method;
            $order->total_Price = $request->total_Price;
            $order->core_rent = $request->core_rent;
            $order->otc = $request->otc;
            $order->real_ip = $request->real_ip;
            $order->visit_type = $request->visit_type;
            $order->connect_type = $request->connect_type;
            $order->security_money_type = $request->security_money_type;
            $order->security_money_amount = $request->security_money_amount;
            $order->marketing_user_id = $request->marketing_user_id;
            $order->accounts_user_id = $request->accounts_user_id;
            $order->save();
            DB::commit();
            Toastr::success('Order Info Added Successful!.', '', ["progressbar" => true]);
            return redirect()->route('orderDetailEdit', ['id' => $order->id]);
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
    public function fetch_district(Request $request)
    {
        $districts = District::where('division_id', $request->id)->orderBy('name','ASC')->get();

        $option = '<option selected disabled hidden value=""> Select one</option>';
        foreach ($districts as $row) {
            $option = $option . '<option value="' . $row->id . '">' . $row->name . '</option>';
        }
        return response()->json($option);
    }

    public function fetch_thana(Request $request)
    {
        $upazilas = Upazila::where('district_id', $request->id)->orderBy('name','ASC')->get();

        $option = '<option selected disabled hidden value=""> Select one</option>';
        foreach ($upazilas as $row) {
            $option = $option . '<option value="' . $row->id . '">' . $row->name . '</option>';
        }
        return response()->json($option);
    }
}
