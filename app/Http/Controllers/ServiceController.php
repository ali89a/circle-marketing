<?php

namespace App\Http\Controllers;

use App\Models\Service;
use App\Models\OrderItem;
use Illuminate\Http\Request;
use Brian2694\Toastr\Facades\Toastr;

class ServiceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = [
            'services' => Service::latest('id')->get(),
        ];
        return view('admin.service.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data = [
            'model' => new Service(),
        ];

        return view('admin.service.create', $data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|unique:services,name',
          
        ]);

        $service = Service::create([
            'name' => $request->input('name'),
            'type' => $request->input('type')
        ]);
       

        Toastr::success('Service Information Created Successfully!.', '', ["progressbar" => true]);
        return redirect()->route('service.index');
    }
   

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Service  $service
     * @return \Illuminate\Http\Response
     */
    public function show(Service $service)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Service  $service
     * @return \Illuminate\Http\Response
     */
    public function edit(Service $service)
    {
        $data = [
            'model' => $service,
           

        ];
        return view('admin.service.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Service  $service
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Service $service)
    {
        $request->validate([
            'name' => 'required|unique:services,name,' . $service->id,
        ]);

        $service->name = $request->input('name');
        $service->type = $request->input('type');
        $service->save();
        Toastr::success('Service Information crated Successfully!.', '', ["progressBar" => true]);
        return redirect()->route('service.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Service  $service
     * @return \Illuminate\Http\Response
     */
    public function destroy(Service $service)
    {
        $service->delete();
        Toastr::success('Service Deleted Successfully!.', '', ["progressBar" => true]);
        return redirect()->back();
    }

    public function fetchService($id)
    {
       $service=Service::find($id);
       return $service;
    }
    public function fetch_general_product_info($id)
    {
        $requisition_product = OrderItem::with('service')->where('order_id', $id)->get();

        $location_items = [];
        foreach ($requisition_product as $row) {
            array_push($location_items, [
                'order_id' => $row->order_id,
                'service_id' => $row->service_id,
                'name' => $row->service->name,
                'price' => $row->price,
                'capacity' => $row->capacity,
            ]);
        }
        return response()->json($location_items);
    }
}
