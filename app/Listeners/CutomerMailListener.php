<?php

namespace App\Listeners;

use App\Events\CutomerMailEvent;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class CutomerMailListener implements ShouldQueue
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  CutomerMailEvent  $event
     * @return void
     */
    public function handle(CutomerMailEvent $event)
    {
        Log::info('lisener'.$event->user);
        $email=$event->user->email;
        $mobile=$event->user->mobile;
        $details = [
            'title' => 'Mail from Circle Network',
            'body' => "Username:$email,Password:$mobile"
        ];

        Mail::to($event->user->email)->send(new \App\Mail\CustomerMail($details));
    }
}
