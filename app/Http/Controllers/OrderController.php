<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\User;
use App\Models\Order;
use App\Models\Service;
use App\Models\Upazila;
use App\Models\District;
use App\Models\Division;
use App\Models\OrderInfo;
use App\Models\OrderItem;
use App\Models\Admin\Admin;
use App\Models\OrderBuffer;
use App\Models\OrderNOCInfo;
use Illuminate\Http\Request;
use App\Models\OrderApproval;
use App\Models\OrderUpgration;
use App\Models\OrderDowngration;
use App\Models\OrderCustomerInfo;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Support\Facades\Auth;
use App\Models\OrderCustomerDocument;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function orderUpgration($id)
    {
        $all_service = Service::all();
        $customer_order_info = OrderInfo::with('order')->where('order_id', $id)->first();
        return view('admin.work-order.upgration', compact('customer_order_info', 'all_service'));
    }
    public function orderDowngration($id)
    {
        $all_service = Service::all();
        $customer_order_info = OrderInfo::with('order')->where('order_id', $id)->first();
        return view('admin.work-order.downgration', compact('customer_order_info', 'all_service'));
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
    public function index()
    {
        $data = [
            'orders' => Order::with('customer_details')->latest()->get(),
            'noc_users' => Admin::role(['NOC Executive', 'NOC Admin'])->get()
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

        if (Auth::guard('admin')->user()->hasRole('Marketing Executive') || Auth::guard('admin')->user()->hasRole('Marketing Admin')) {
            $users = User::where('creator_user_id', Auth::guard('admin')->user()->id)->latest()->get();
        } else {
            $users = User::latest()->get();
        }

        $data = [
            'divisions' => Division::all(),
            'customers' => $users,
        ];
        return view('admin.work-order.create', $data);
    }
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
            return view('admin.work-order.order_edit', compact('customer_order', 'users'));
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
            return view('admin.work-order.order_detail_edit', compact('customer_order_info', 'all_service'));
        }
    }
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
        return redirect()->route('work-order.index');
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
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $request->validate([
            'customer_id' => 'required',
        ]);

        // try {
        //     DB::beginTransaction();
        $order = new Order();
        $order->customer_id = $request->customer_id;
        $order->completion_status = 'Processing';
        $order->creator_user_id = Auth::guard('admin')->user()->id;
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
        $customer_info->customer_id = $request->customer_id;
        $customer_info->division_id = $request->division_id;
        $customer_info->district_id = $request->district_id;
        $customer_info->upazila_id = $request->upazila_id;
        $customer_info->order_id = $order->id;
        $customer_info->save();
        // DB::commit();
        // Toastr::success('Customer Info Added Successful!.', '', ["progressbar" => true]);
        return redirect()->route('docEdit', ['id' => $order->id]);
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
        return redirect()->route('orderDetailEdit', ['id' => $order->id]);
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
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function destroy(Order $order)
    {
        //
    }
    public function fetch_district(Request $request)
    {
        $districts = District::where('division_id', $request->id)->orderBy('name', 'ASC')->get();

        $option = '<option selected disabled hidden value=""> Select one</option>';
        foreach ($districts as $row) {
            $option = $option . '<option value="' . $row->id . '">' . $row->name . '</option>';
        }
        return response()->json($option);
    }

    public function fetch_thana(Request $request)
    {
        $upazilas = Upazila::where('district_id', $request->id)->orderBy('name', 'ASC')->get();

        $option = '<option selected disabled hidden value=""> Select one</option>';
        foreach ($upazilas as $row) {
            $option = $option . '<option value="' . $row->id . '">' . $row->name . '</option>';
        }
        return response()->json($option);
    }
}
