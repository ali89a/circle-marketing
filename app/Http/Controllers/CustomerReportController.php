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
        //  if ($request->user()->can('report-approve')) {
        $contact = Admin::where('admins.id', Auth::user()->id)->first();
        // dd($contact);
        //all();
        $reports = DB::table('customer_reports')
            ->leftJoin('customer_service_reports', 'customer_reports.id', '=', 'customer_service_reports.customer_report_id')
            ->join('districts', 'customer_reports.location_district', 'districts.id')
            ->join('upazilas', 'customer_reports.location_upazila', 'upazilas.id')
            ->where(function ($query) {
                $query->where('customer_service_reports.ctype', '=', 'approved')
                    ->orWhere('customer_service_reports.ctype', '=', 'followup')
                    ->orWhere('customer_service_reports.ctype', '=', 'reconnect');
            });
        if (!$request->user()->can('report-approve')) {
            $reports->where('customer_reports.createdBy', Auth::user()->id);
        }
        $reports->select('customer_reports.*', 'customer_service_reports.*', 'districts.name as district', 'upazilas.name as upazila')
            ->orderBy('customer_reports.id', 'DESC');

        //  dd($reports->get());
        // return view('admin.report.index', compact('reports'), ('contact'));
        return view('admin.report.index', [
            'reports' => $reports->paginate(10),
            //->get(),
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
        // dd($request->all());
        $this->validate($request, [
            'cname' => 'required',
            'email' => 'required|unique:customer_reports,email',
            'contact_number' =>
            //'required|regex:/^([0-9\s\-\+\(\)]*)$/|min:10',
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
        //
    }

    public function edit(CustomerReport $customerReport)
    {
        //  $report = CustomerReport::findOrFail($customerReport);
        //  return view('admin.report.edit', compact('report'));
    }

    public function update(Request $request)
    {
        //dd($request->all());
        $this->validate($request, [
            // 'visiting_card' => 'required|mimes:jpeg,jpg,png,webp,gif|max:10240',
            'audio' => 'mimes:3gp,mp3,mpc,msv,wav,awb|max:102400',
        ]);
        $report = new CustomerServiceReport();
        $report->customer_report_id = $request->customer_report_id;
        $report->ctype = $request->ctype;
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
        // if ($request->user()->can('report-approve')) {
        //  $contact = Admin::all();
        $contact = Admin::where('admins.id', Auth::user()->id)->first();
        $pendingList = DB::table('customer_reports')
            ->leftJoin('customer_service_reports', 'customer_reports.id', '=', 'customer_service_reports.customer_report_id')
            ->join('districts', 'customer_reports.location_district', 'districts.id')
            ->join('upazilas', 'customer_reports.location_upazila', 'upazilas.id')
            ->where('customer_service_reports.ctype', '=', 'new');
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
            //->get(),
            'contact' => $contact
        ]);
    }

    public function approve($id)
    {
        $report = CustomerServiceReport::find($id);
        $report->ctype = 'approved';
        $report->save();
        return redirect()->back()->with('message', 'report unpublished successfully');
    }

    public function cancel($id)
    {
        $report = CustomerReport::find($id);
        $report->delete();
        Toastr::success('Information Canceled Successful!.', '', ["progressbar" => true]);
        return redirect()->route('report.index');
    }

    public function followUp()
    {
        $reports = DB::table('customer_reports')
            ->leftJoin('customer_service_reports', 'customer_reports.id', '=', 'customer_service_reports.customer_report_id')
            ->join('districts', 'customer_reports.location_district', 'districts.id')
            ->join('upazilas', 'customer_reports.location_upazila', 'upazilas.id')
            ->where('customer_reports.createdBy', Auth::user()->id)
            ->where('customer_service_reports.ctype', '=', 'approved')
            ->select('customer_reports.*', 'customer_service_reports.*', 'districts.name as district', 'upazilas.name as upazila')
            ->get();
        return view('admin.report.followup', compact('reports'));
    }

    public function fetchAll($id)
    {
    $reports = CustomerReport::with('district', 'upazila')->where('id', $id)->first();
        // $reports = DB::table('customer_reports')
        //     ->where('id', $id)
        //     ->first();

        //   dd($reports->toArray());

        // $reports = DB::table('customer_reports')
        //     ->leftJoin('customer_service_reports', 'customer_reports.id', '=', 'customer_service_reports.customer_report_id')
        //     ->join('districts', 'customer_reports.location_district', 'districts.id')
        //     ->join('upazilas', 'customer_reports.location_upazila', 'upazilas.id')
        //     ->where('customer_reports.id', $id)
        //     ->select('customer_reports.*', 'districts.name as district', 'upazilas.name as upazila')
        //     ->first();
        // dd($reports);

        //   $reports = CustomerReport::where('id', $id)->first();
        return $reports;
    }

    public function allUpazila($id)
    {
        $reports = Upazila::where('district_id', $id)->get();
        return $reports;
    }

    public function searchResult(Request $request)
    {
        // dd($request->all());
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
                        $query->where('customer_service_reports.ctype', '=', 'approved')
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
                        $query->where('customer_service_reports.ctype', '=', 'approved')
                            ->orWhere('customer_service_reports.ctype', '=', 'followup')
                            ->orWhere('customer_service_reports.ctype', '=', 'reconnect');
                    });
            } else if (!empty($request->name)) {
                // dd($request->all());
                $list = DB::table('customer_reports')
                    ->leftJoin('customer_service_reports', 'customer_reports.id', '=', 'customer_service_reports.customer_report_id')
                    ->join('districts', 'customer_reports.location_district', 'districts.id')
                    ->join('upazilas', 'customer_reports.location_upazila', 'upazilas.id')
                    ->join('admins', 'customer_reports.createdBy', 'admins.id')
                    ->where('admins.name', $request->name)
                    ->where(function ($query) {
                        $query->where('customer_service_reports.ctype', '=', 'approved')
                            ->orWhere('customer_service_reports.ctype', '=', 'followup')
                            ->orWhere('customer_service_reports.ctype', '=', 'reconnect');
                    });
                // dd($list);
                //  dd('TEXT');
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
        // dd($request->all());
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
                    ->where('customer_service_reports.ctype', '=', 'new');
            } else if (!empty($request->contact_number)) {
                $list = DB::table('customer_reports')
                    ->leftJoin('customer_service_reports', 'customer_reports.id', '=', 'customer_service_reports.customer_report_id')
                    ->join('districts', 'customer_reports.location_district', 'districts.id')
                    ->join('upazilas', 'customer_reports.location_upazila', 'upazilas.id')
                    ->where('customer_reports.contact_number',  $request->contact_number)
                    ->where('customer_service_reports.ctype', '=', 'new');
            } else if (!empty($request->name)) {
                // dd($request->all());
                $list = DB::table('customer_reports')
                    ->leftJoin('customer_service_reports', 'customer_reports.id', '=', 'customer_service_reports.customer_report_id')
                    ->join('districts', 'customer_reports.location_district', 'districts.id')
                    ->join('upazilas', 'customer_reports.location_upazila', 'upazilas.id')
                    ->join('admins', 'customer_reports.createdBy', 'admins.id')
                    ->where('admins.name', $request->name)
                    ->where('customer_service_reports.ctype', '=', 'new');
                // dd($list);
                //  dd('TEXT');
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
        $users = Admin::all();
        foreach ($users as $u) {
            $check = DB::table('work_limits')
                ->where('admin_id', $u->id)
                ->first();
            if (empty($check)) {
                WorkLimit::create([
                    'admin_id' => $u->id
                ]);
            }
            // print_r($check);
            // echo '<br>';
        }
        // dd();
        $workLimit = DB::table('work_limits')
            ->join('admins', 'work_limits.admin_id', '=', 'admins.id')
            ->select('work_limits.*', 'admins.name');
        return view('admin.marketing.workLimit', [
            'workLimit' => $workLimit->get()
        ]);
        // return view('admin.marketing.workLimit', [
        //     'users' => $users
        // ]);
    }

    public function storeWorkLimit(Request $request)
    {
        //dd($request->all());
        //  $admin = WorkLimit::find($request->id);
        $admin = $request->admin_id;
        $newclient = $request->newclient;
        $followup = $request->followup;
        $reconnect = $request->reconnect;
        foreach ($admin as $key => $no) {
            $input['admin_id'] = $no;
            $input['newclient'] = $newclient[$key];
            $input['followup'] = $followup[$key];
            $input['reconnect'] = $reconnect[$key];
            WorkLimit::insert($input);
            //   WorkLimit::whereIn('admin_id', '$request->admin_id')->update($input);
            //  DB::update("update products set display_index = $caseString end where id in ($ids)");
        }

        return redirect(route('marketingWorkLimit'));
    }

    public function marketingReportAnalysis()
    {

        return view('admin.marketing.reportAnalysis');
    }
}