<?php

namespace App\Http\Controllers;

use App\Models\CustomerRelation;
use Illuminate\Http\Request;

class CustomerRelationController extends Controller
{

    public function index()
    {
        return view('admin.crm.index');
    }


    public function create()
    {
        return view('admin.crm.create');
    }


    public function store(Request $request)
    {
        //
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
        return view('');
    }


    public function crmWorkAnalysis()
    {
        return view('');
    }
}