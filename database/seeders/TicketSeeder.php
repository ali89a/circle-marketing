<?php

namespace Database\Seeders;

use App\Models\SupportTicket;
use App\Models\TicketCategory;
use App\Models\TicketPriorities;
use App\Models\TicketStatus;
use Illuminate\Database\Seeder;

class TicketSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $data = array(
            [
                'name' => 'Open',
                'color' => '#593f7a'
            ],[
                'name' => 'Close',
                'color' => '#53fc28'
            ]
            );

        TicketStatus::insert($data);

        $data = array(
            [
                'name' => 'Speed Slow'            
            ],[
                'name' => 'Link Down'
            ],[
                'name' => 'Billing Issue'
            ]
        );
        TicketCategory::insert($data);

        $data = array(
                [
                    'name' => 'Normal'
                ],[
                    'name' => 'Medium'
                ],[
                    'name' => 'High'
                ]
            );

        TicketPriorities::insert($data);


        $data = array([
            'support_id' => 1,
            'customer_id' => 1,
            'title' => 'Link speed very slow',
            'problem_details' => 'very solo line',
            'status_id' => 1,
            'category_id' => 1,
            'priority_id' => 1,
            'tokenhas' => md5(1),
            'created_at' => now(),
            'updated_at' => now()
        ],[
            'customer_id' => 1,
            'support_id' => null,
            'title' => 'Link Down',
            'problem_details' => 'Line down for 30 hour',
            'status_id' => 1,
            'category_id' => 1,
            'priority_id' => 1,
            'tokenhas' => md5(1),
            'created_at' => now(),
            'updated_at' => now()
        ]);

        SupportTicket::insert($data);        
    }
}
