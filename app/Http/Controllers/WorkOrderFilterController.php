<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Order;
use App\Models\Admin\Admin;
use Illuminate\Http\Request;

class WorkOrderFilterController extends Controller
{

    public function pendingWorkOrdersearch($key)
    {
        if ($key == 'marketing') {
            $orders = Order::with('customer_details')->whereHas('order_approval', function ($q) {
                $q->where('m_approved_status', 'Pending');
            })->latest()->get();
        }
        dd($orders);
        $data = [
            'orders' => $orders,
            'noc_users' => Admin::role(['NOC Executive', 'NOC Admin'])->get()
        ];
        return view('admin.work-order.index', $data);
    }
    public function searchOrderResult(Request $request)
    {
        //dd($request->all());

        if ($request->ajax()) {
            if (empty($request->m_approved_status) && empty($request->noc_approved_status) && empty($request->org_name) && empty($request->scl_id) && empty($request->submitted_by) && empty($request->client_type) && !empty($request->from_date) && !empty($request->to_date)) {

                $start = Carbon::parse($request->from_date)->format('Y-m-d');
                $end = Carbon::parse($request->to_date)->format('Y-m-d');

                $orders = Order::with('customer_details')
                    ->whereBetween('created_at', [$start . " 00:00:00", $end . " 23:59:59"])
                    ->latest()
                    ->get();
            } elseif (empty($request->m_approved_status) && empty($request->noc_approved_status) && empty($request->org_name) && empty($request->scl_id) && empty($request->submitted_by) && !empty($request->client_type) && empty($request->from_date) && empty($request->to_date)) {

                $orders = Order::with('customer_details')
                    ->where('client_type', $request->client_type)
                    ->latest()
                    ->get();
            } elseif (empty($request->m_approved_status) && empty($request->noc_approved_status) && empty($request->org_name) && empty($request->scl_id) && !empty($request->submitted_by) && empty($request->client_type) && empty($request->from_date) && empty($request->to_date)) {

                $orders = Order::with('customer_details')
                    ->where('visit_type', $request->submitted_by)
                    ->latest()
                    ->get();
            } elseif (empty($request->m_approved_status) && empty($request->noc_approved_status) && empty($request->org_name) && !empty($request->scl_id) && empty($request->submitted_by) && empty($request->client_type) && empty($request->from_date) && empty($request->to_date)) {

                $orders = Order::with('customer_details')
                    ->where('scl_id', $request->scl_id)
                    ->latest()
                    ->get();
            } elseif (empty($request->m_approved_status) && empty($request->noc_approved_status) && !empty($request->org_name) && empty($request->scl_id) && empty($request->submitted_by) && empty($request->client_type) && empty($request->from_date) && empty($request->to_date)) {

                $orders = Order::with('customer_details')
                    ->where('scl_id', $request->org_name)
                    ->latest()
                    ->get();
            } elseif (empty($request->m_approved_status) && !empty($request->noc_approved_status) && empty($request->org_name) && empty($request->scl_id) && empty($request->submitted_by) && empty($request->client_type) && empty($request->from_date) && empty($request->to_date)) {

                dd('12');
            } elseif (!empty($request->m_approved_status) && empty($request->noc_approved_status) && empty($request->org_name) && empty($request->scl_id) && empty($request->submitted_by) && empty($request->client_type) && empty($request->from_date) && empty($request->to_date)) {

                dd('11');
            }
            //END SINGLE FIELD 
            elseif (empty($request->m_approved_status) && empty($request->noc_approved_status) && empty($request->org_name) && empty($request->scl_id) && empty($request->submitted_by) && !empty($request->client_type) && !empty($request->from_date) && !empty($request->to_date)) {

                dd('21');
            } elseif (!empty($request->m_approved_status) && !empty($request->noc_approved_status) && !empty($request->org_name) && !empty($request->scl_id) && !empty($request->submitted_by) && !empty($request->client_type) && !empty($request->from_date) && !empty($request->to_date)) {
                dd('3');
                $start = Carbon::parse($request->from_date)->format('Y-m-d');
                $end = Carbon::parse($request->to_date)->format('Y-m-d');

                $orders = Order::with('customer_details')
                    ->whereBetween('created_at', [$start . " 00:00:00", $end . " 23:59:59"])
                    ->latest()
                    ->get();
            } else {
                $orders = [];
            }
            $data = [
                'orders' => $orders,
                'noc_users' => Admin::role(['NOC Executive', 'NOC Admin'])->get()
            ];

            return view('admin.work-order.result', $data);
        }
    }
}
