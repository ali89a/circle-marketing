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


    public function crmWorkAnalysis()
    {
        return view('admin.crm.analysis');
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
}