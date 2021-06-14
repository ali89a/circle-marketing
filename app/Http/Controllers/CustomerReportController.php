<?php

namespace App\Http\Controllers;

use App\Models\CustomerReport;
use Illuminate\Http\Request;


use Illuminate\Support\Facades\DB;
use Brian2694\Toastr\Facades\Toastr;

class CustomerReportController extends Controller
{

    public function index()
    {
        $reports = CustomerReport::where('ctype', 'followUp')->get();
        return view('admin.report.index', compact('reports'));
    }


    public function create()
    {
        return view('admin.report.create');
    }


    public function store(Request $request)
    {
        // dd($request->all());
        $this->validate($request, [
            'cname' => 'required',
        ]);
        $report = new CustomerReport();
        $report->fill($request->all());
        $report->save();


        Toastr::success('Information Added Successful!.', '', ["progressbar" => true]);
        return redirect()->route('pendingList');
    }


    public function show(CustomerReport $customerReport)
    {
        //
    }


    public function edit(CustomerReport $customerReport)
    {
        //
    }


    public function update(Request $request, CustomerReport $customerReport)
    {
        $report = CustomerReport::find($customerReport);
        $report->fill($request->all());
        $report->update();
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
        $pendingList = CustomerReport::where('ctype', 'new')->get();
        return view('admin.report.pending', [
            'pendingList' => $pendingList,
        ]);
    }

    
}