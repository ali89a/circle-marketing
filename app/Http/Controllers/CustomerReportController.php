<?php

namespace App\Http\Controllers;

use App\Models\CustomerReport;
use App\Models\CustomerServiceReport;
use App\Models\District;
use App\Models\Upazila;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;

class CustomerReportController extends Controller
{

    public function index()
    {
        $reports = DB::table('customer_reports')
            ->leftJoin('customer_service_reports', 'customer_reports.id', '=', 'customer_service_reports.customer_report_id')
            ->join('districts', 'customer_reports.location_district', 'districts.id')
            ->join('upazilas', 'customer_reports.location_upazila', 'upazilas.id')
            ->where('customer_reports.createdBy', Auth::user()->id)
            ->where(function ($query) {
                $query->where('customer_service_reports.ctype', '=', 'approved')
                    ->orWhere('customer_service_reports.ctype', '=', 'followup')
                    ->orWhere('customer_service_reports.ctype', '=', 'reconnect');
            })
            ->select('customer_reports.*', 'customer_service_reports.*', 'districts.name as district', 'upazilas.name as upazila')
            ->get();
        // dd($reports->all());
        return view('admin.report.index', compact('reports'));
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
            'email' => 'required|unique:customer_reports,email',
            'contact_number' => 'required|unique:customer_reports,contact_number',
            'visiting_card' => 'required|mimes:jpeg,jpg,png,webp,gif|max:10240',
            'audio' => 'required|mimes:3gp,mp3,mpc,msv,wav,awb|max:102400',
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
            'audio' => 'required|mimes:3gp,mp3,mpc,msv,wav,awb|max:102400',
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

    public function pendingList()
    {
        $pendingList = DB::table('customer_reports')
            ->leftJoin('customer_service_reports', 'customer_reports.id', '=', 'customer_service_reports.customer_report_id')
            ->join('districts', 'customer_reports.location_district', 'districts.id')
            ->join('upazilas', 'customer_reports.location_upazila', 'upazilas.id')
            ->where('customer_reports.createdBy', Auth::user()->id)
            ->where('customer_service_reports.ctype', '=', 'new')
            ->select('customer_reports.*', 'customer_service_reports.*', 'districts.name as district', 'upazilas.name as upazila')
            ->get();
        return view('admin.report.pending', [
            'pendingList' => $pendingList,
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
        $reports = CustomerReport::where('customer_reports.createdBy', Auth::user()->id)
            ->get();
        return view('admin.report.followup', compact('reports'));
    }

    public function fetchAll($id)
    {
        $reports = CustomerReport::where('id', $id)->first();
        return $reports;
    }
    
    public function allUpazila($id)
    {
        $reports = Upazila::where('district_id', $id)->get();
        return $reports;
    }
}