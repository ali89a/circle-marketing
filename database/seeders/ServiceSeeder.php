<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ServiceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $services = array(

            array('id' => '1','name' => 'Internet'),
            array('id' => '2','name' => 'BDIX'),
            array('id' => '3','name' => 'It Service 1'),
            array('id' => '4','name' => 'It Service 2'),
            array('id' => '5','name' => 'Data'),
            
        );

        DB::table('services')->insert($services);
    }
}
