<?php

namespace App\Http\Controllers;

use App\Models\CrmWorkLimit;
use App\Models\CustomerRelation;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CustomerRelationController extends Controller
{

    public function index()
    {
        $crms = CustomerRelation::all();
        return view('admin.crm.index', compact('crms'));
    }


    public function create()
    {
        return view('admin.crm.create');
    }


    public function store(Request $request)
    {
        // $this->validate($request, [
        //     'cname' => 'required',
        //     'email' => 'required|unique:customer_reports,email',
        //     'contact_number' =>
        //     'required|unique:customer_reports|digits:11,contact_number',
        //     'visiting_card' => 'required|mimes:jpeg,jpg,png,webp,gif,pdf|max:10240',
        //     'audio' => 'mimes:3gp,mp3,mpc,msv,wav,awb|max:102400',
        // ]);

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


    public function edit(CustomerRelation $customerRelation)
    {
        //
    }


    public function update(Request $request, CustomerRelation $customerRelation)
    {
        //
    }


    public function destroy(CustomerRelation $customerRelation)
    {
        //
    }


    public function crmWorkLimit()
    {
        $workLimit = CrmWorkLimit::first();
        // DB::table('crm_work_limits')
        //         ->select('work_limits.*', 'admins.name');


        return view(
            'admin.crm.workLimit',
            ['workLimit' => $workLimit]
        );
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
}