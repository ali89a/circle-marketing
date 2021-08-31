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

            array('id' => '1','name' => 'Internet','type'=>'separate'),
            array('id' => '2','name' => 'BDIX','type'=>'general'),
            array('id' => '3','name' => 'It Service 1','type'=>'general'),
            array('id' => '4','name' => 'It Service 2','type'=>'general'),
            array('id' => '5','name' => 'Data','type'=>'general'),
            
        );

        DB::table('services')->insert($services);
    }
}
