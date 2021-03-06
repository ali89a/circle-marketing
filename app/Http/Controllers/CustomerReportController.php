<?php

namespace App\Http\Controllers;

use App\Models\Admin\Admin;
use App\Models\CustomerReport;
use App\Models\CustomerServiceReport;
use App\Models\District;
use App\Models\Role;
use App\Models\Upazila;
use App\Models\WorkLimit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Carbon\Carbon;

class CustomerReportController extends Controller
{

    public function index(Request $request)
    {
        $contact = Admin::where('admins.id', Auth::user()->id)->first();
        $reports = DB::table('customer_reports')
            ->leftJoin('customer_service_reports', 'customer_reports.id', '=', 'customer_service_reports.customer_report_id')
            ->join('districts', 'customer_reports.location_district', 'districts.id')
            ->join('upazilas', 'customer_reports.location_upazila', 'upazilas.id')
            ->where(function ($query) {
                $query->where('customer_reports.status', '=', 'approved')
                    ->orWhere('customer_reports.status', '=', 'canceled');
            });
        if (!$request->user()->can('report-approve')) {
            $reports->where('customer_reports.createdBy', Auth::user()->id);
        }
        $reports->select('customer_reports.*', 'customer_service_reports.*', 'districts.name as district', 'upazilas.name as upazila')
            ->orderBy('customer_reports.id', 'DESC');
        return view('admin.report.index', [
            'reports' => $reports->paginate(10),
            'contact' => $contact
        ]);
    }

    public function create()
    {
        $districts = District::all();
        return view('admin.report.create', compact('districts'));
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'cname' => 'required',
            'email' => 'required|unique:customer_reports,email',
            'contact_number' =>
            'required|unique:customer_reports|digits:11,contact_number',
            'visiting_card' => 'required|mimes:jpeg,jpg,png,webp,gif,pdf|max:10240',
            'audio' => 'mimes:3gp,mp3,mpc,msv,wav,awb|max:102400',
        ]);
        $report = new CustomerReport();
        $report->fill($request->all());
        $report->save();
        $serviceInfo = new CustomerServiceReport();
        $serviceInfo->customer_report_id = $report->id;
        $serviceInfo->fill($request->all());
        if ($request->visiting_card != null) {
            $fileName = time() . '.' . $request->visiting_card->extension();
            $request->visiting_card->move(storage_path('app/public/visitingCard'), $fileName);
            $serviceInfo->visiting_card = $fileName;
        }
        if ($request->audio != null) {
            $fileName2 = time() . '.' . $request->audio->extension();
            $request->audio->move(storage_path('app/public/audio'), $fileName2);
            $serviceInfo->audio = $fileName2;
        }
        $serviceInfo->save();
        Toastr::success('Information Added Successful!.', '', ["progressbar" => true]);
        return redirect()->route('pendingList');
    }

    public function show(CustomerReport $customerReport)
    {
    }

    public function edit(CustomerReport $customerReport)
    {
    }

    public function update(Request $request)
    {
        $this->validate($request, [
            'audio' => 'mimes:3gp,mp3,mpc,msv,wav,awb|max:102400',
        ]);
        $report = new CustomerServiceReport();
        $report->customer_report_id = $request->report_id;
        $report->ctype = $request->ctype;
        $report->isp_type = $request->isp_type;
        $report->bandwidth = $request->bandwidth;
        $report->visit_phone = $request->visit_phone;
        $report->rate = $request->rate;
        $report->otc = $request->otc;
        $report->remark = $request->remark;
        if ($request->audio != null) {
            $fileName = time() . '.' . $request->audio->extension();
            $request->audio->move(storage_path('app/public/audio'), $fileName);
            $report->audio = $fileName;
        }
        $report->save();
        Toastr::success('Information Updated Successfully!.', '', ["closeButton" => "true", "progressBar" => "true"]);
        return redirect()->route('report.index');
    }

    public function destroy(CustomerReport $customerReport)
    {
        $report = CustomerReport::find($customerReport);
        $report->delete();
        Toastr::success('Information Deleted Successful!.', '', ["progressbar" => true]);
        return redirect()->route('report.index');
    }

    public function pendingList(Request $request)
    {
        $contact = Admin::where('admins.id', Auth::user()->id)->first();
        $pendingList = DB::table('customer_reports')
            ->leftJoin('customer_service_reports', 'customer_reports.id', '=', 'customer_service_reports.customer_report_id')
            ->join('districts', 'customer_reports.location_district', 'districts.id')
            ->join('upazilas', 'customer_reports.location_upazila', 'upazilas.id')
            ->where('customer_reports.status', '=', 'new');
        if (!$request->user()->can('report-approve')) {
            $pendingList->where('customer_reports.createdBy', Auth::user()->id);
        }
        $pendingList->select(
            'customer_reports.*',
            'customer_service_reports.*',
            'districts.name as district',
            'upazilas.name as upazila'
        )
            ->orderBy('customer_reports.id', 'DESC');
        return view('admin.report.pending', [
            'pendingList' => $pendingList->paginate(10),
            'contact' => $contact
        ]);
    }

    public function approve($id)
    {
        $report = CustomerReport::find($id);
        $report->status = 'approved';
        $report->save();
        return redirect()->back()->with('message', 'report approved successfully');
    }

    public function cancel($id)
    {
        $report = CustomerReport::find($id);
        $report->status = 'canceled';
        $report->save();
        return redirect()->back()->with('message', 'report cancelled successfully');
    }

    public function followUp()
    {
        $reports = DB::table('customer_reports')
            ->leftJoin('customer_service_reports', 'customer_reports.id', '=', 'customer_service_reports.customer_report_id')
            ->join('districts', 'customer_reports.location_district', 'districts.id')
            ->join('upazilas', 'customer_reports.location_upazila', 'upazilas.id')
            ->where('customer_reports.createdBy', Auth::user()->id)
            ->where('customer_reports.status', '=', 'approved')
            ->where('customer_service_reports.ctype', '=', 'new')
            ->select('customer_reports.*', 'customer_service_reports.*', 'districts.name as district', 'upazilas.name as upazila')
            ->get();
        return view('admin.report.followup', compact('reports'));
    }

    public function fetchAll($id)
    {
        $reports = CustomerReport::with('district', 'upazila')->where('id', $id)->first();
        return $reports;
    }

    public function allUpazila($id)
    {
        $reports = Upazila::where('district_id', $id)->get();
        return $reports;
    }

    public function searchResult(Request $request)
    {
        if ($request->ajax()) {
            if (!empty($request->from_date) && !empty($request->to_date)) {
                $from = $request->from_date == '' ? today() : Carbon::parse($request->from_date);
                $to   = $request->to_date == '' ? today() : Carbon::parse($request->to_date);
                $list = DB::table('customer_reports')
                    ->leftJoin('customer_service_reports', 'customer_reports.id', '=', 'customer_service_reports.customer_report_id')
                    ->join('districts', 'customer_reports.location_district', 'districts.id')
                    ->join('upazilas', 'customer_reports.location_upazila', 'upazilas.id')
                    ->where('customer_reports.created_at', '>', $from)
                    ->where('customer_reports.created_at', '<', $to->addDay())
                    ->where(function ($query) {
                        $query->where('customer_reports.status', '=', 'approved')
                            ->orWhere('customer_reports.status', '=', 'canceled')
                            ->orWhere('customer_service_reports.ctype', '=', 'followup')
                            ->orWhere('customer_service_reports.ctype', '=', 'reconnect');
                    });
            } else if (!empty($request->contact_number)) {
                $list = DB::table('customer_reports')
                    ->leftJoin('customer_service_reports', 'customer_reports.id', '=', 'customer_service_reports.customer_report_id')
                    ->join('districts', 'customer_reports.location_district', 'districts.id')
                    ->join('upazilas', 'customer_reports.location_upazila', 'upazilas.id')
                    ->where('customer_reports.contact_number',  $request->contact_number)
                    ->where(function ($query) {
                        $query->where('customer_reports.status', '=', 'approved')
                            ->orWhere('customer_reports.status', '=', 'canceled')
                            ->orWhere('customer_service_reports.ctype', '=', 'followup')
                            ->orWhere('customer_service_reports.ctype', '=', 'reconnect');
                    });
            } else if (!empty($request->name)) {
                $list = DB::table('customer_reports')
                    ->leftJoin('customer_service_reports', 'customer_reports.id', '=', 'customer_service_reports.customer_report_id')
                    ->join('districts', 'customer_reports.location_district', 'districts.id')
                    ->join('upazilas', 'customer_reports.location_upazila', 'upazilas.id')
                    ->join('admins', 'customer_reports.createdBy', 'admins.id')
                    ->where('admins.name', $request->name)
                    ->where(function ($query) {
                        $query->where('customer_reports.status', '=', 'approved')
                            ->orWhere('customer_reports.status', '=', 'canceled')
                            ->orWhere('customer_service_reports.ctype', '=', 'followup')
                            ->orWhere('customer_service_reports.ctype', '=', 'reconnect');
                    });
            }
            if (!$request->user()->can('report-approve')) {
                $list->where('customer_reports.createdBy', Auth::user()->id);
            }
            $list->select('customer_reports.*', 'customer_service_reports.*', 'districts.name as district', 'upazilas.name as upazila')
                ->orderBy('customer_reports.id', 'DESC');
            return view('admin.report.result', [
                'r'           =>  $list->get(),
            ]);
        }
    }

    public function pendingSearchResult(Request $request)
    {
        if ($request->ajax()) {
            if (!empty($request->from_date) && !empty($request->to_date)) {
                $from = $request->from_date == '' ? today() : Carbon::parse($request->from_date);
                $to   = $request->to_date == '' ? today() : Carbon::parse($request->to_date);
                $list = DB::table('customer_reports')
                    ->leftJoin('customer_service_reports', 'customer_reports.id', '=', 'customer_service_reports.customer_report_id')
                    ->join('districts', 'customer_reports.location_district', 'districts.id')
                    ->join('upazilas', 'customer_reports.location_upazila', 'upazilas.id')
                    ->where('customer_reports.created_at', '>', $from)
                    ->where('customer_reports.created_at', '<', $to->addDay())
                    ->where('customer_reports.status', '=', 'new');
            } else if (!empty($request->contact_number)) {
                $list = DB::table('customer_reports')
                    ->leftJoin('customer_service_reports', 'customer_reports.id', '=', 'customer_service_reports.customer_report_id')
                    ->join('districts', 'customer_reports.location_district', 'districts.id')
                    ->join('upazilas', 'customer_reports.location_upazila', 'upazilas.id')
                    ->where('customer_reports.contact_number',  $request->contact_number)
                    ->where('customer_reports.status', '=', 'new');
            } else if (!empty($request->name)) {
                $list = DB::table('customer_reports')
                    ->leftJoin('customer_service_reports', 'customer_reports.id', '=', 'customer_service_reports.customer_report_id')
                    ->join('districts', 'customer_reports.location_district', 'districts.id')
                    ->join('upazilas', 'customer_reports.location_upazila', 'upazilas.id')
                    ->join('admins', 'customer_reports.createdBy', 'admins.id')
                    ->where('admins.name', $request->name)
                    ->where('customer_reports.status', '=', 'new');
            }
            if (!$request->user()->can('report-approve')) {
                $list->where('customer_reports.createdBy', Auth::user()->id);
            }
            $list->select('customer_reports.*', 'customer_service_reports.*', 'districts.name as district', 'upazilas.name as upazila')
                ->orderBy('customer_reports.id', 'DESC');
            return view('admin.report.pendingResult', [
                'r'           =>  $list->get(),
            ]);
        }
    }

    public function marketingWorkLimit()
    {
        if (Auth::guard('admin')->user()->hasRole('Marketing Executive') || Auth::guard('admin')->user()->hasRole('Marketing Admin')) {
            $users = Admin::all();
            foreach ($users as $u) {
                if ($u->hasRole('Marketing Executive') || $u->hasRole('Marketing Admin')) {
                    $check = DB::table('work_limits')
                        ->where('admin_id', $u->id)
                        ->first();
                    if (empty($check)) {
                        WorkLimit::create([
                            'admin_id' => $u->id
                        ]);
                    }
                }
                $workLimit = DB::table('work_limits')
                    ->join('admins', 'work_limits.admin_id', '=', 'admins.id')
                    ->select('work_limits.*', 'admins.name');
            }
            return view('admin.marketing.workLimit', [
                'workLimit' => $workLimit->get()
            ]);
        }
    }

    public function storeWorkLimit(Request $request)
    {
        $workLimit = WorkLimit::find($request->id);
        if (count($request->id) > 0) {
            foreach ($request->id as $item => $value) {
                $datad = array(
                    'newclient' => $request->newclient[$item],
                    'followupclient' => $request->followupclient[$item],
                    'reconnectclient' => $request->reconnectclient[$item],
                );
                $workLimit = WorkLimit::where('id', $request->id[$item])->first();
                $workLimit->update($datad);
            }
        }
        return redirect(route('marketingWorkLimit'));
    }

    public function marketingReportAnalysis()
    {
        return view('admin.marketing.reportAnalysis');
    }


    public function reportAnalysisResult(Request $request)
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
                $different_days = $from->diffInDays($to); //
                return view('admin.marketing.result', [
                    'total'       =>  $total,
                    'different_days'       =>  $different_days,
                    'from'       =>  $from,
                    'to'       =>  $to,
                    'users' => $users
                ]);
            }
        }
    }



    public function indexPrint(Request $request)
    {
        $contact = Admin::where('admins.id', Auth::user()->id)->first();
        $reports = DB::table('customer_reports')
        ->leftJoin('customer_service_reports', 'customer_reports.id', '=', 'customer_service_reports.customer_report_id')
        ->join('districts', 'customer_reports.location_district', 'districts.id')
        ->join('upazilas', 'customer_reports.location_upazila', 'upazilas.id')
        ->where(function ($query) {
            $query->where('customer_reports.status', '=', 'approved')
            ->orWhere('customer_reports.status', '=', 'canceled');
        });
        if (!$request->user()->can('report-approve')) {
            $reports->where('customer_reports.createdBy', Auth::user()->id);
        }
        $reports->select('customer_reports.*', 'customer_service_reports.*', 'districts.name as district', 'upazilas.name as upazila')
        ->orderBy('customer_reports.id', 'DESC');
        return view('admin.report.indexPrint', [
            'reports' => $reports->paginate(10),
            'contact' => $contact
        ]);
    }
    
}