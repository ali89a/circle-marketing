<?php

namespace App\Http\Controllers\Customer;

use App\Models\Order;
use App\Models\Service;
use App\Models\Division;
use App\Models\OrderInfo;
use App\Models\OrderItem;
use App\Models\Admin\Admin;
use App\Models\OrderBuffer;
use App\Models\OrderNOCInfo;
use Illuminate\Http\Request;
use App\Models\OrderApproval;
use App\Models\OrderCustomerInfo;
use App\Http\Controllers\Controller;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Support\Facades\Auth;
use App\Models\OrderCustomerDocument;

class WorkOrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = [
            'orders' => Order::with('customer_details')->where('customer_id',Auth::user()->id)->latest()->get(),
        ];
        return view('customer.work-order.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data = [
            'divisions' => Division::all(),
        ];
        return view('customer.work-order.create',$data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $request->validate([
            'organization' => 'required',
        ]);

        // try {
        //     DB::beginTransaction();
        $order = new Order();
        $order->customer_id = Auth::user()->id;
        $order->completion_status = 'Processing';
        $order->creator_user_id = Auth::user()->id;
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

        $order_approval = new OrderApproval();
        $order_approval->m_approved_status = 'Pending';
        $order_approval->a_approved_status = 'Pending';
        $order_approval->coo_approved_status = 'Pending';
        $order_approval->noc_assigned_status = 'Pending';
        $order_approval->noc_approved_status = 'Pending';
        $order_approval->order_id = $order->id;
        $order_approval->save();


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
        $customer_info->customer_id = Auth::user()->id;
        $customer_info->division_id = $request->division_id;
        $customer_info->district_id = $request->district_id;
        $customer_info->upazila_id = $request->upazila_id;
        $customer_info->order_id = $order->id;
        $customer_info->save();
        // DB::commit();
        // Toastr::success('Customer Info Added Successful!.', '', ["progressbar" => true]);
        return redirect()->route('customer.docEdit', ['id' => $order->id]);
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
    public function docEdit($id)
    {
        $customer_info = OrderCustomerInfo::where('order_id', $id)->first();
       // dd($customer_info);
        if ($customer_info->organization == '' || $customer_info->client_type == '' || $customer_info->technical_email == '' || $customer_info->occupation == '' || $customer_info->billing_email == '' || $customer_info->mobile == '' || $customer_info->technical_address == '' || $customer_info->billing_address == '' || $customer_info->customer_id == '' || $customer_info->division_id == '' || $customer_info->district_id == '' || $customer_info->upazila_id == '') {
            return redirect()->back();
        } else {
            $customer_doc = OrderCustomerDocument::where('order_id', $id)->first();
            return view('customer.work-order.doc_edit', compact('customer_doc'));
        }
    }
    public function docUpdate(Request $request, $id)
    {
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
        // DB::commit();
        Toastr::success('Customer Doc Added Successful!.', '', ["progressbar" => true]);
        return redirect()->route('customer.orderEdit', ['id' => $id]);
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

    public function customerDetailEdit($id)
    {
        $data = [
            'divisions' => Division::all(),
            'order_customer_info' => OrderCustomerInfo::where('order_id', $id)->first()
        ];
        return view('customer.work-order.customer_detail_edit', $data);
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
        //  DB::commit();
        Toastr::success('Customer Info Added Successful!.', '', ["progressbar" => true]);
        return redirect()->route('customer.docEdit', ['id' => $id]);
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

 public function orderEdit($id)
    {
        $customer_document = OrderCustomerDocument::where('order_id', $id)->first();
        //dd($customer_document);
        if ($customer_document->work_order == '' || $customer_document->authorization == '' || $customer_document->ip_agreement == '' || $customer_document->noc == '') {
            Toastr::error('Please Fillup Required Field!.', '', ["progressBar" => true]);
            return redirect()->back();
        } else {
            $customer_order = Order::where('id', $id)->first();
            $users = Admin::role(['Marketing Executive', 'Marketing Admin'])->get();
            return view('customer.work-order.order_edit', compact('customer_order', 'users'));
        }
    }
    public function orderDetailEdit($id)
    {
        $customer_order = Order::where('id', $id)->first();
        // dd($customer_order);
        if ($customer_order->type == '' || $customer_order->price == '' || $customer_order->gmap_location == '' || $customer_order->connect_type == '' || $customer_order->visit_type == '' || $customer_order->bill_generate_method == '' || $customer_order->order_submission_date == '' || $customer_order->billing_cycle == '' || $customer_order->billing_remark == '' || $customer_order->bill_start_date == '' || $customer_order->delivery_date == '') {
            Toastr::error('Please Fillup Required Field!.', '', ["progressBar" => true]);
            return redirect()->back();
        } else {
            $customer_order_info = OrderInfo::where('order_id', $id)->first();
            $all_service = Service::all();
            return view('customer.work-order.order_detail_edit', compact('customer_order_info', 'all_service'));
        }
    }
    public function orderDetailUpdate(Request $request, $id)
    {
        // dd($request->all());
        $request->validate([
            'items' => 'array|required',
        ]);

        // try {

        //     DB::beginTransaction();
        $order = Order::find($id);

        $order->total_price = $request->total_price;
        $order->real_ip = $request->real_ip;
        $order->core_rent = $request->core_rent;
        $order->otc = $request->otc;
        $order->vat = $request->vat;
        $order->completion_status = 'Complete';
        $order->save();
        OrderItem::where('order_id', $id)->delete();
        $products = $request->get('items');

        foreach ($products as $key => $product) {
            $item = new OrderItem();
            $item->order_id = $order->id;
            $item->service_id = $product['service_id'];
            $item->capacity = $product['capacity'];
            $item->price = $product['price'];
            $item->save();
        }
        //  DB::commit();
        Toastr::success('Order Detail Added Successful!.', '', ["progressbar" => true]);
        return redirect()->route('customer.order.index');
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
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        // try {
        //     DB::beginTransaction();
        $order = Order::where('id', $id)->first();
        $order->type = $request->type;
        $order->price = $request->price;
        $order->scl_id = $request->scl_id;
        $order->gmap_location = $request->gmap_location;
        $order->link_id = 'NC_' . \App\Classes\LinkId::serial_number();
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
        $order->security_money_cheque = $request->security_money_cheque;
        $order->security_money_cash = $request->security_money_cash;
        $order->marketing_user_id = $request->marketing_user_id;
        $order->accounts_user_id = $request->accounts_user_id;
        $order->save();
        // DB::commit();
        Toastr::success('Order Info Added Successful!.', '', ["progressbar" => true]);
        return redirect()->route('customer.orderDetailEdit', ['id' => $order->id]);
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
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
