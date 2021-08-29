<?php

namespace App\Http\Controllers\Support;

use Illuminate\Http\Request;
use App\Models\TicketPriorities;
use App\Http\Controllers\Controller;
use Brian2694\Toastr\Facades\Toastr;

class PrioritiesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('Support.priorities.index',[
            'title' => 'Ticket Priorities',
            'data' => TicketPriorities::all()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('Support.priorities.create',[
            'title' => 'Add New Ticket Priorities'
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request,TicketPriorities $ticketPriorities)
    {
        $request->validate([
            'name' => 'required'
        ]);

        $ticketPriorities->name = $request->name;
        $ticketPriorities->save();

        Toastr::success('Priorities Created Successfully!.', '', ["progressBar" => true]);
        return redirect()->route('support-priorities.index'); 
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
        return view('Support.priorities.edit',[
            'priorities' => TicketPriorities::find($id)
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

       

        TicketPriorities::whereId($id)
                    ->update([
                        'name' => $request->name
                    ]);

        Toastr::success('Ticket Priorities Name Update Successfully!.', '', ["progressBar" => true]);
        return redirect()->route('support-priorities.index'); 
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
