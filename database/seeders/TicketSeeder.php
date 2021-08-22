<?php

namespace Database\Seeders;

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
    }
}
