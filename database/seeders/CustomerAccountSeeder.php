<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CustomerAccountSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('user')
            ->create([
                'name' => 'Mahbub Alam',
                'email' => 'razu@circlenetworkbd.net',
                'password' => bcrypt('12345678'),
                'mobile' => '01944455001',
                'billing_address' => 'savar',
                'bin_no' => '000001',
                'img_url' => '1629708799.jpg',
                'btrc_license_url' => '1629708799.jpg',
                'nid_url' => '1629708799.jpg',
                'trade_license_url' => '1629708799.jpg',
                'contact_authorization_url' => '1629708799.jpg',
                'assigned_user_id' => 5,
                'creator_user_id' => 5,
                'updator_user_id' => 5,
                'created_at' => now(),
                'updated_at' => now()
                
            ]);
    }
}
