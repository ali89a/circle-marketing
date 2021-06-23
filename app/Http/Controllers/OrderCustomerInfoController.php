<?php

namespace App\Http\Controllers;

use App\Models\District;
use Illuminate\Http\Request;
use App\Models\OrderCustomerInfo;
use App\Models\Upazila;

class OrderCustomerInfoController extends Controller
{

    public function fetch_district($id)
    {

        $data = [
            'districts' => District::where('division_id', $id)->orderBy('name', 'ASC')->get()
        ];

        return $data;
    }
    public function fetch_upazila($id)
    {

        $data = [
            'upazilas' => Upazila::where('district_id', $id)->orderBy('name', 'ASC')->get()
        ];

        return $data;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
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
     * @param  \App\Models\OrderCustomerInfo  $orderCustomerInfo
     * @return \Illuminate\Http\Response
     */
    public function show(OrderCustomerInfo $orderCustomerInfo)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\OrderCustomerInfo  $orderCustomerInfo
     * @return \Illuminate\Http\Response
     */
    public function edit(OrderCustomerInfo $orderCustomerInfo)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\OrderCustomerInfo  $orderCustomerInfo
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, OrderCustomerInfo $orderCustomerInfo)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\OrderCustomerInfo  $orderCustomerInfo
     * @return \Illuminate\Http\Response
     */
    public function destroy(OrderCustomerInfo $orderCustomerInfo)
    {
        //
    }
}
