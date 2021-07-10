<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\InvoiceApproval;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Support\Facades\Auth;

class InvoiceApprovalController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function invoiceApprovalNOC($invoice_id)
    {
        $invoice_approval = InvoiceApproval::where('invoice_id', $invoice_id)->first();
        $invoice_approval->noc_approved_status = "Approved";
        $invoice_approval->noc_approved_by = Auth::guard('admin')->id();
        $invoice_approval->noc_approved_time = now();
        $invoice_approval->save();

        Toastr::success('Noc Approved Successful!.', '', ["progressbar" => true]);
        return redirect()->back();
    }
    public function invoiceApprovalMarketing($invoice_id)
    {
        $invoice_approval = InvoiceApproval::where('invoice_id', $invoice_id)->first();
        $invoice_approval->m_approved_status = "Approved";
        $invoice_approval->m_approved_by = Auth::guard('admin')->id();
        $invoice_approval->m_approved_time = now();
        $invoice_approval->save();

        Toastr::success('Marketing Approved Successful!.', '', ["progressbar" => true]);
        return redirect()->back();
    }
    public function invoiceApprovalAccounts($invoice_id)
    {
        $invoice_approval = InvoiceApproval::where('invoice_id', $invoice_id)->first();
        $invoice_approval->a_approved_status = "Approved";
        $invoice_approval->a_approved_by = Auth::guard('admin')->id();
        $invoice_approval->a_approved_time = now();
        $invoice_approval->save();

        Toastr::success('Accounts Approved Successful!.', '', ["progressbar" => true]);
        return redirect()->back();
    }
    public function invoiceApprovalCoo($invoice_id)
    {
        $invoice_approval = InvoiceApproval::where('invoice_id', $invoice_id)->first();
        $invoice_approval->coo_approved_status = "Approved";
        $invoice_approval->coo_approved_by = Auth::guard('admin')->id();
        $invoice_approval->coo_approved_time = now();
        $invoice_approval->save();

        Toastr::success('COO Approved Successful!.', '', ["progressbar" => true]);
        return redirect()->back();
    }
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\InvoiceApproval  $invoiceApproval
     * @return \Illuminate\Http\Response
     */
    public function show(InvoiceApproval $invoiceApproval)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\InvoiceApproval  $invoiceApproval
     * @return \Illuminate\Http\Response
     */
    public function edit(InvoiceApproval $invoiceApproval)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\InvoiceApproval  $invoiceApproval
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, InvoiceApproval $invoiceApproval)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\InvoiceApproval  $invoiceApproval
     * @return \Illuminate\Http\Response
     */
    public function destroy(InvoiceApproval $invoiceApproval)
    {
        //
    }
}
