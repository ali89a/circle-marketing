<?php

namespace App\Http\Controllers\Support;

use App\Models\Admin\Admin;
use Illuminate\Http\Request;
use App\Models\SupportTicket;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Admin\AdminController;
use App\Models\TicketCategory;
use App\Models\TicketComment;
use App\Models\TicketPriorities;
use App\Models\TicketStatus;
use App\Models\User;
use Database\Seeders\TicketSeeder;

class SupportTicketController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('Support.ticket.index',[
            'data' => SupportTicket::with('priority','category','status')->latest('updated_at')->paginate(50),
            'title' => 'Support Ticket List'
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {


        // dd(TicketCategory::categoryoptions());


        return view('Support.ticket.create',[
            'title' => 'Open New Ticket',
            'employee' => Admin::all(),
            'customers' => User::all(),
            'categories' => TicketCategory::all(),
            'priorities' => TicketPriorities::all()
        ]);
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
            'customer_id' => 'required',
            'title' => 'required',
            'category_id' => 'required',
            'priority_id' => 'required',
            'problem_details' => 'required'
        ]);

        // dd($request->attachments);

        // if ($request->img_url != null) {
        //     $fileName = time() . '.' . $request->img_url->extension();
        //     $request->img_url->move(storage_path('app/public/customer'), $fileName);
        //     $user->img_url = $fileName;
        // }

        $paths = [];

        if($request->attachments){

        foreach($request->file('attachments') as $attachment){

             $filename = time().rand(1,1000).'.'.$attachment->extension();
            
            // dd($attachment);
            $attachment->move(storage_path('app/public/support_ticket_attachment/'.$request->customer_id),$filename);
            $paths[] = $filename;
        }
    }

        // dd($paths);

        $attachment = '';

        $data = array();


        SupportTicket::create([
            'customer_id'       => $request->customer_id,
            'support_id'        => auth()->user()->id,
            'title'             => $request->title,
            'category_id'       => $request->category_id,
            'priority_id'       => $request->priority_id,
            'problem_details'   => $request->problem_details,
            'cc_recipents'      => $request->cc,
            'customer_email'    => User::find($request->customer_id)->email, 
            'status_id'         => 1,
            'attachment'        => json_encode($paths)
        ]);

        return redirect()->route('support-ticket.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {


        $supportTicket = SupportTicket::with('customer','ticketComments','ticketComments.supportuser','ticketComments.customer','supportuser')->find($id);

        // dd($supportTicket);

                
        return view('Support.ticket.show',[
            'ticket' => $supportTicket,
            'title' => 'Ticket Details'
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
            'comment' => 'required'
        ]);
       

        $customer_id = SupportTicket::find($id)->customer_id;       

        $paths = [];
        
        if($request->attachments){

        foreach($request->file('attachments') as $attachment){

             $filename = time().rand(1,1000).'.'.$attachment->extension();
            
            // dd($attachment);
            $attachment->move(storage_path('app/public/support_ticket_attachment/'.$customer_id),$filename);
            $paths[] = $filename;
        }

    }

        // dd($paths);

        $attachment = '';

        $data = array();

        SupportTicket::where('id',$id)
                        ->update(['updated_at' => now() ]);

        TicketComment::create([
            'ticket_id'         => $id,
            'support_id'        => auth()->user()->id,
            'comment'           => $request->comment,
            'attachment'        => json_encode($paths)
        ]);

        return redirect()->route('support-ticket.index');
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
