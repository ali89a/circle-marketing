<?php

namespace App\Http\Controllers;

use App\Models\CustomerReport;
use App\Models\CustomerServiceReport;
use App\Models\District;
use App\Models\Upazila;
use Illuminate\Http\Request;


use Illuminate\Support\Facades\DB;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Support\Facades\File;

class CustomerReportController extends Controller
{

    public function index()
    {
        $reports = CustomerServiceReport::where('ctype', 'followUp')->get();
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
            //   "contact_number" => "required|unique:contact_number",
            'email' => 'required|email|unique:users',
            'contact_number' => 'required|min:11|numeric',
            // 'contact_number' => 'required|phone|unique:customer_reports,contact_number',
            // 'email' => 'required|email|unique:customer_reports,email',

        ]);
        $report = new CustomerReport();
        $report->fill($request->all());
        $report->save();

        $serviceInfo = new CustomerServiceReport();
        // $serviceInfo->fill($request->all());
        $serviceInfo->customer_report_id = $report->id;
        $serviceInfo->fill($request->all());
        // $serviceInfo->ctype = $request->ctype;
        // $serviceInfo->isp_type = $request->isp_type;
        // $serviceInfo->visiting_card = $request->visiting_card;
        // $serviceInfo->bandwidth = $request->bandwidth;
        // $serviceInfo->rate = $request->rate;
        // $serviceInfo->otc = $request->otc;
        // $serviceInfo->remark = $request->remark;
        // $serviceInfo->audio = $request->audio;

        // $serviceInfo = CustomerReport::get($request->id);

        if (
            $request->visiting_card != null
        ) {
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
        $report = CustomerReport::findOrFail($request->id);
        // $report = new CustomerReport();
        // $report->fill($request->all());
        $report->ctype = $request->ctype;
        $report->bandwidth = $request->bandwidth;
        $report->createdBy = $request->createdBy;
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
        $pendingList = CustomerServiceReport::where('ctype', 'new')->get();
        return view('admin.report.pending', [
            'pendingList' => $pendingList,
        ]);
    }


    public function approve($id)
    {
        $report = CustomerServiceReport::find($id);
        $report->ctype = 'followup';
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
        $reports = CustomerReport::all();
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