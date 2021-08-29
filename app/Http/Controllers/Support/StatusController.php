<?php

namespace App\Http\Controllers\Support;


use App\Models\TicketStatus;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Brian2694\Toastr\Facades\Toastr;

class StatusController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        
        return view('Support.status.index',[
            'data' => TicketStatus::get(),
            'title' => 'Status Code'
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        
        return view('Support.status.create',[
            'title' => 'Status Code'
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request,TicketStatus $ticketstatus)
    {

        
        $request->validate([
            'name' => 'required'
        ]);

        $ticketstatus->name = $request->name;
        $ticketstatus->color = $request->color;

        $ticketstatus->save();

        // $ticketstatus->insert([
        //     'name' => $request->name,
        //     'color' => $request->color
        // ]);

        Toastr::success('Status Created Successfully!.', '', ["progressBar" => true]);
        return redirect()->route('support-status.index'); 


    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {

        return view('Support.status.edit',[
            'title' => 'Status Code',
            'ticketstatus' => TicketStatus::find($id)
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required'
        ]);

       

        TicketStatus::whereId($id)
                    ->update([
                        'name' => $request->name,
                        'color' => $request->color
                    ]);

        Toastr::success('Status Update Successfully!.', '', ["progressBar" => true]);
        return redirect()->route('support-status.index'); 
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
