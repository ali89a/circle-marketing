<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class role_has_permission extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //

        $count_permission = DB::table('permissions')->count();
        $count_role = DB::table('roles')->count();

        for($i=1;$i<=$count_role;$i++){
            $data = [];
            for($j=1;$j<=$count_permission;$j++){
                $data[$j]['permission_id'] = $j;
                $data[$j]['role_id'] = $i;
            }
            
            // dd($data);
    
            DB::table('role_has_permissions')->insert($data);
        }
        
    }
}
