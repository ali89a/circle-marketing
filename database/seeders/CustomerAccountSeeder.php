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

        $data = array([
            'name' => 'Mahbub Alam',
            'email' => 'razu@circlenetworkbd.net',
            'password' => bcrypt('12345678'),
            'mobile' => '01944455001',
            'billing_address' => 'savar',
            'bin_no' => '000001',
            'img_url' => '1629884881.png',
            'btrc_license_url' => '1629708799.jpg',
            'nid_url' => '1629708799.jpg',
            'trade_license_url' => '1629708799.jpg',
            'contact_authorization_url' => '1629708799.jpg',
            'accounts_user_id' => 5,
            'marketing_user_id' => 8,
            'creator_user_id' => 5,
            'updator_user_id' => 5,
            'created_at' => now(),
            'updated_at' => now()
            
        ],[
            'name' => 'Soikot Hossain',
            'email' => 'soikot@circlenetworkbd.net',
            'password' => bcrypt('12345678'),
            'mobile' => '01944455002',
            'billing_address' => 'savar',
            'bin_no' => '000002',
            'img_url' => '1629884881.png',
            'btrc_license_url' => '1629708799.jpg',
            'nid_url' => '1629708799.jpg',
            'trade_license_url' => '1629708799.jpg',
            'contact_authorization_url' => '1629708799.jpg',
            'accounts_user_id' => 6,
            'marketing_user_id' => 9,
            'creator_user_id' => 5,
            'updator_user_id' => 5,
            'created_at' => now(),
            'updated_at' => now()
            
        ],[
            'name' => 'Razib Hossain',
            'email' => 'razib@circlenetworkbd.net',
            'password' => bcrypt('12345678'),
            'mobile' => '01944455003',
            'billing_address' => 'savar',
            'bin_no' => '000003',
            'img_url' => '1629884881.png',
            'btrc_license_url' => '1629708799.jpg',
            'nid_url' => '1629708799.jpg',
            'trade_license_url' => '1629708799.jpg',
            'contact_authorization_url' => '1629708799.jpg',
            'accounts_user_id' => 6,
            'marketing_user_id' => 9,
            'creator_user_id' => 5,
            'updator_user_id' => 5,
            'created_at' => now(),
            'updated_at' => now()
            
        ]);
        DB::table('users')
            ->insert($data);
    }
}
