<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(DivisionSeeder::class);
        $this->call(DistrictSeeder::class);
        $this->call(UpazilaSeeder::class);
        $this->call(ServiceSeeder::class);
        $this->call(AccessControlsTableSeeder::class);
        $this->call(TicketSeeder::class);
        // \App\Models\User::factory(10)->create();
    }
}
