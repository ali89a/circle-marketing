<?php

namespace App\Http\Controllers;

use App\Models\Admin\Admin;
use App\Models\CrmWorkLimit;
use App\Models\CustomerRelation;
use App\Models\Order;
use App\Models\User;
use Brian2694\Toastr\Facades\Toastr;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class CustomerRelationController extends Controller
{

    public function index()
    {
        // $crms = CustomerRelation::all();
        $crms = DB::table('customer_relations')
            ->join('users', 'customer_relations.applicantname', '=', 'users.id')
            ->join('admins', 'customer_relations.user', '=', 'admins.id')
            ->select('customer_relations.*', 'users.mobile', 'users.name as userName', 'admins.name as adminName')
            ->orderBy('customer_relations.id', 'DESC')
            ->get();
        return view('admin.crm.index', compact('crms'));
    }


    public function create()
    {
        $customers = User::all();
        $admins = Admin::all();
        $workOrders = Order::all();
        return view('admin.crm.create', [
            'customers' => $customers,
            'admins' => $admins,
            'workOrders' => $workOrders
        ]);
    }


    public function store(Request $request)
    {
        $report = new CustomerRelation();
        $report->fill($request->all());
        $report->save();
        Toastr::success('Information Added Successful!.', '', ["progressbar" => true]);
        return redirect()->route('customer-relation.index');
    }


    public function show(CustomerRelation $customerRelation)
    {
        //
    }


    public function edit($id)
    {
        $crm = CustomerRelation::find($id);
        $customers = User::all();
        $admins = Admin::all();
        $workOrders = Order::all();

        return view('admin.crm.edit', [
            'crm' => $crm,
            'customers' => $customers,
            'admins' => $admins,
            'workOrders' => $workOrders
        ]);
    }


    public function update(Request $request)
    {
        //dd($request->all());
        $crm = CustomerRelation::find($request->id);
        $crm->fill($request->all());
        $crm->update();
        Toastr::success('Information Updated Successful!.', '', ["progressbar" => true]);
        return redirect()->route('customer-relation.index');
    }


    public function destroy(CustomerRelation $customerRelation)
    {
        //
    }


    public function crmWorkLimit(Request $request)
    {

        $check = DB::table('crm_work_limits')
            // ->where('admin_id', $u->id)
            ->first();
        if (empty($check)) {
            CrmWorkLimit::create([
                'id' => $request->id
            ]);
        }


        $workLimit = CrmWorkLimit::first();
        return view('admin.crm.workLimit', ['workLimit' => $workLimit]);
    }

    public function storeWorkLimit(Request $request)
    {
        $workLimit = CrmWorkLimit::find($request->id);
        $datad = array(
            'blimit' => $request->blimit,
            'mlimit' => $request->mlimit,
            'climit' => $request->climit,
            'llimit' => $request->llimit,
        );
        $workLimit = CrmWorkLimit::where('id', $request->id)->first();
        $workLimit->update($datad);
        return redirect(route('customerWorkLimit'));
    }



    public function crmSearchResult(Request $request)
    {
        if ($request->ajax()) {
            if (!empty($request->from_date) && !empty($request->to_date)) {
                $from = $request->from_date == '' ? today() : Carbon::parse($request->from_date);
                $to   = $request->to_date == '' ? today() : Carbon::parse($request->to_date);
                $list = DB::table('customer_relations')
                    ->join('users', 'customer_relations.applicantname', '=', 'users.id')
                    ->join('admins', 'customer_relations.user', '=', 'admins.id')
                    ->where('customer_relations.created_at', '>', $from)
                    ->where('customer_relations.created_at', '<', $to->addDay());
            } else if (!empty($request->mobile)) {
                $list = DB::table('customer_relations')
                    ->join('users', 'customer_relations.applicantname', '=', 'users.id')
                    ->join('admins', 'customer_relations.user', '=', 'admins.id')
                    ->where('users.mobile',  $request->mobile);
            } else if (!empty($request->issue_type)) {
                $list = DB::table('customer_relations')
                    ->join('users', 'customer_relations.applicantname', '=', 'users.id')
                    ->join('admins', 'customer_relations.user', '=', 'admins.id')
                    ->where('customer_relations.issue_type',  $request->issue_type);
            }

            $list->select('customer_relations.*', 'users.*', 'users.name as userName', 'admins.name as adminName')
                ->orderBy('customer_relations.id', 'DESC');
            return view('admin.crm.result', [
                'crms'           =>  $list->get(),
            ]);
        }
    }

    public function crmWorkAnalysis()
    {
        return view('admin.crm.analysis');
    }


    public function crmAnalysisResult(Request $request)
    {
        if ($request->ajax()) {
            if (!empty($request->from_date) && !empty($request->to_date)) {
                $from = $request->from_date == '' ? today() : Carbon::parse($request->from_date);
                $to   = $request->to_date == '' ? today() : Carbon::parse($request->to_date)->addDay();
                $users = Admin::all();
                $total = array();
                foreach ($users as $u) {
                    if ($u->hasRole('Marketing Executive') || $u->hasRole('Marketing Admin')) {
                        $total[$u->id]['name'] = $u->name;
                        $total[$u->id]['new'] = DB::table('customer_service_reports')
                            ->leftJoin('customer_reports', 'customer_service_reports.customer_report_id', '=', 'customer_reports.id')
                            ->where('customer_service_reports.created_at', '>', $from)
                            ->where('customer_service_reports.created_at', '<', $to)
                            // ->whereBetween('created_at', [$from . " 00:00:00", $to . " 23:59:59"])
                            ->where('customer_reports.createdBy', $u->id)
                            ->where('customer_service_reports.ctype', 'new')
                            ->count();
                        $total[$u->id]['followup'] = DB::table('customer_service_reports')
                            ->leftJoin('customer_reports', 'customer_service_reports.customer_report_id', '=', 'customer_reports.id')
                            ->where('customer_service_reports.created_at', '>', $from)
                            ->where('customer_service_reports.created_at', '<', $to)
                            // ->where('customer_service_reports.created_at', '>=', [$from . " 00:00:00"])
                            // ->where('customer_service_reports.created_at', '<=', [$to . " 23:59:59"])
                            ->where('customer_reports.createdBy', $u->id)
                            ->where('customer_service_reports.ctype', 'followup')
                            ->count();
                        $total[$u->id]['reconnect'] = DB::table('customer_service_reports')
                            ->leftJoin('customer_reports', 'customer_service_reports.customer_report_id', '=', 'customer_reports.id')
                            ->where('customer_service_reports.created_at', '>', $from)
                            ->where('customer_service_reports.created_at', '<', $to)
                            ->where('customer_reports.createdBy', $u->id)
                            ->where('customer_service_reports.ctype', 'reconnect')
                            ->count();
                        $total[$u->id]['newclient'] = DB::table('work_limits')
                            ->where('work_limits.admin_id', $u->id)
                            ->select('work_limits.newclient')->first();
                        $total[$u->id]['followupclient'] = DB::table('work_limits')
                            ->where('work_limits.admin_id', $u->id)
                            ->select('work_limits.followupclient')->first();
                        $total[$u->id]['reconnectclient'] = DB::table('work_limits')
                            ->where('work_limits.admin_id', $u->id)
                            ->select('work_limits.reconnectclient')->first();
                        $total[$u->id]['new1'] = DB::table('customer_service_reports')
                            ->leftJoin('customer_reports', 'customer_service_reports.customer_report_id', '=', 'customer_reports.id')
                            ->where('customer_service_reports.created_at', '>', $from)
                            ->where('customer_service_reports.created_at', '<', $to)
                            ->where('customer_reports.createdBy', $u->id)
                            ->where('customer_service_reports.ctype', 'new')
                            ->where('customer_service_reports.isp_type', 'category_a')
                            ->count();
                        $total[$u->id]['new2'] = DB::table('customer_service_reports')
                            ->leftJoin('customer_reports', 'customer_service_reports.customer_report_id', '=', 'customer_reports.id')
                            ->where('customer_service_reports.created_at', '>', $from)
                            ->where('customer_service_reports.created_at', '<', $to)
                            ->where('customer_reports.createdBy', $u->id)
                            ->where('customer_service_reports.ctype', 'new')
                            ->where('customer_service_reports.isp_type', 'category_b')
                            ->count();
                        $total[$u->id]['new3'] = DB::table('customer_service_reports')
                            ->leftJoin('customer_reports', 'customer_service_reports.customer_report_id', '=', 'customer_reports.id')
                            ->where('customer_service_reports.created_at', '>', $from)
                            ->where('customer_service_reports.created_at', '<', $to)
                            ->where('customer_reports.createdBy', $u->id)
                            ->where('customer_service_reports.ctype', 'new')
                            ->where('customer_service_reports.isp_type', 'category_c')
                            ->count();
                        $total[$u->id]['follow1'] = DB::table('customer_service_reports')
                            ->leftJoin('customer_reports', 'customer_service_reports.customer_report_id', '=', 'customer_reports.id')
                            ->where('customer_service_reports.created_at', '>', $from)
                            ->where('customer_service_reports.created_at', '<', $to)
                            ->where('customer_reports.createdBy', $u->id)
                            ->where('customer_service_reports.ctype', 'followup')
                            ->where('customer_service_reports.isp_type', 'category_a')
                            ->count();
                        $total[$u->id]['follow2'] = DB::table('customer_service_reports')
                            ->leftJoin('customer_reports', 'customer_service_reports.customer_report_id', '=', 'customer_reports.id')
                            ->where('customer_service_reports.created_at', '>', $from)
                            ->where('customer_service_reports.created_at', '<', $to)
                            ->where('customer_reports.createdBy', $u->id)
                            ->where('customer_service_reports.ctype', 'followup')
                            ->where('customer_service_reports.isp_type', 'category_b')
                            ->count();
                        $total[$u->id]['follow3'] = DB::table('customer_service_reports')
                            ->leftJoin('customer_reports', 'customer_service_reports.customer_report_id', '=', 'customer_reports.id')
                            ->where('customer_service_reports.created_at', '>', $from)
                            ->where('customer_service_reports.created_at', '<', $to)
                            ->where('customer_reports.createdBy', $u->id)
                            ->where('customer_service_reports.ctype', 'followup')
                            ->where('customer_service_reports.isp_type', 'category_c')
                            ->count();
                        $total[$u->id]['reconnect1'] = DB::table('customer_service_reports')
                            ->leftJoin('customer_reports', 'customer_service_reports.customer_report_id', '=', 'customer_reports.id')
                            ->where('customer_service_reports.created_at', '>', $from)
                            ->where('customer_service_reports.created_at', '<', $to)
                            ->where('customer_reports.createdBy', $u->id)
                            ->where('customer_service_reports.ctype', 'reconnect')
                            ->where('customer_service_reports.isp_type', 'category_a')
                            ->count();
                        $total[$u->id]['reconnect2'] = DB::table('customer_service_reports')
                            ->leftJoin('customer_reports', 'customer_service_reports.customer_report_id', '=', 'customer_reports.id')
                            ->where('customer_service_reports.created_at', '>', $from)
                            ->where('customer_service_reports.created_at', '<', $to)
                            ->where('customer_reports.createdBy', $u->id)
                            ->where('customer_service_reports.ctype', 'reconnect')
                            ->where('customer_service_reports.isp_type', 'category_b')
                            ->count();
                        $total[$u->id]['reconnect3'] = DB::table('customer_service_reports')
                            ->leftJoin('customer_reports', 'customer_service_reports.customer_report_id', '=', 'customer_reports.id')
                            ->where('customer_service_reports.created_at', '>', $from)
                            ->where('customer_service_reports.created_at', '<', $to)
                            ->where('customer_reports.createdBy', $u->id)
                            ->where('customer_service_reports.ctype', 'reconnect')
                            ->where('customer_service_reports.isp_type', 'category_c')
                            ->count();
                    }
                }
              //  dd($total);
                $different_days = $from->diffInDays($to); //
                return view('admin.crm.analysisResult', [
                    'total'       =>  $total,
                    'different_days'       =>  $different_days,
                    'from'       =>  $from,
                    'to'       =>  $to,
                    'users' => $users
                ]);
            }
        }
    }
}