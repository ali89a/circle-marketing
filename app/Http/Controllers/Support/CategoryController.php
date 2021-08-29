<?php

namespace App\Http\Controllers\Support;

use Illuminate\Http\Request;
use App\Models\TicketCategory;
use App\Http\Controllers\Controller;
use Brian2694\Toastr\Facades\Toastr;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('support.category.index',[
            'title' => 'Ticket Category',
            'data' => TicketCategory::all()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('support.category.create',[
            'title' => 'Create Category'
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request,TicketCategory $ticketCategory)
    {
        $request->validate([
            'name' => 'required'
        ]);

        $ticketCategory->name = $request->name;
        $ticketCategory->save();

        Toastr::success('Category Created Successfully!.', '', ["progressBar" => true]);
        return redirect()->route('support-category.index'); 

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
        return view('Support.category.edit',[
            'ticketcategory' => TicketCategory::find($id)
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

       

        TicketCategory::whereId($id)
                    ->update([
                        'name' => $request->name
                    ]);

        Toastr::success('Ticket Category Update Successfully!.', '', ["progressBar" => true]);
        return redirect()->route('support-category.index'); 
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
