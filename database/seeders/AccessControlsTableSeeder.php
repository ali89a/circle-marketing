<?php
namespace Database\Seeders;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Permission;

class AccessControlsTableSeeder extends Seeder
{


    public function run()
    {

        // Reset cached roles and permissions
        app()['cache']->forget('spatie.permission.cache');

        $dev = \App\Models\User::where('email', 'super@admin.com')->first();

        if (empty($dev)) {

            $data = [
                [
                    'id'=>'1',
                    'name' => 'Super Admin',
                    'email' => 'super@admin.com',
                    'password' => bcrypt('12345678'),
                ],
                [
                    'id'=>'2',
                    'name' => 'Admin',
                    'email' => 'admin@gmail.com',
                    'password' => bcrypt('12345678'),
                ], [
                    'id'=>'3',
                    'name' => 'CEO',
                    'email' => 'ceo@gmail.com',
                    'password' => bcrypt('12345678'),
                ], [
                    'id'=>'4',
                    'name' => 'COO',
                    'email' => 'coo@gmail.com',
                    'password' => bcrypt('12345678'),
                ],[
                    'id'=>'5',
                    'name' => 'Marketing Admin',
                    'email' => 'ma@gmail.com',
                    'password' => bcrypt('12345678'),
                ],[
                    'id'=>'6',
                    'name' => 'Marketing Executive',
                    'email' => 'me@gmail.com',
                    'password' => bcrypt('12345678'),
                ],[
                    'id'=>'7',
                    'name' => 'Accounts Admin',
                    'email' => 'aa@gmail.com',
                    'password' => bcrypt('12345678'),
                ],[
                    'id'=>'8',
                    'name' => 'Accounts Executive',
                    'email' => 'ae@gmail.com',
                    'password' => bcrypt('12345678'),
                ],[
                    'id'=>'9',
                    'name' => 'NOC Admin',
                    'email' => 'na@gmail.com',
                    'password' => bcrypt('12345678'),
                ],[
                    'id'=>'10',
                    'name' => 'NOC Executive',
                    'email' => 'ne@gmail.com',
                    'password' => bcrypt('12345678'),
                ],
            ];

            DB::table('admins')->insert($data);

        }

        $dev = \App\Models\Admin\Admin::where('email', 'super@admin.com')->first();

        //data for roles table
        $data = [
            ['name' => 'Super Admin', 'guard_name' => 'admin'],
            ['name' => 'Admin', 'guard_name' => 'admin'],
            ['name' => 'CEO', 'guard_name' => 'admin'],
            ['name' => 'COO', 'guard_name' => 'admin'],
            ['name' => 'Marketing Admin', 'guard_name' => 'admin'],
            ['name' => 'Marketing Executive', 'guard_name' => 'admin'],
            ['name' => 'Accounts Admin', 'guard_name' => 'admin'],
            ['name' => 'Accounts Executive', 'guard_name' => 'admin'],
            ['name' => 'NOC Admin', 'guard_name' => 'admin'],
            ['name' => 'NOC Executive', 'guard_name' => 'admin'],
        ];
        DB::table('roles')->insert($data);

        //data for permissions table
        $data = [
            ['name' => 'dashboard', 'guard_name' => 'admin'],

            ['name' => 'admin-list', 'guard_name' => 'admin'],
            ['name' => 'admin-create', 'guard_name' => 'admin'],
            ['name' => 'admin-show', 'guard_name' => 'admin'],
            ['name' => 'admin-edit', 'guard_name' => 'admin'],
            ['name' => 'admin-delete', 'guard_name' => 'admin'],

            ['name' => 'role-list', 'guard_name' => 'admin'],
            ['name' => 'role-create', 'guard_name' => 'admin'],
            ['name' => 'role-show', 'guard_name' => 'admin'],
            ['name' => 'role-edit', 'guard_name' => 'admin'],
            ['name' => 'role-delete', 'guard_name' => 'admin'],

            ['name' => 'customer-list', 'guard_name' => 'admin'],
            ['name' => 'customer-create', 'guard_name' => 'admin'],
            ['name' => 'customer-show', 'guard_name' => 'admin'],
            ['name' => 'customer-edit', 'guard_name' => 'admin'],
            ['name' => 'customer-delete', 'guard_name' => 'admin'],
            
            ['name' => 'service-list', 'guard_name' => 'admin'],
            ['name' => 'service-create', 'guard_name' => 'admin'],
            ['name' => 'service-show', 'guard_name' => 'admin'],
            ['name' => 'service-edit', 'guard_name' => 'admin'],
            ['name' => 'service-delete', 'guard_name' => 'admin'],

            ['name' => 'division-list', 'guard_name' => 'admin'],
            ['name' => 'division-create', 'guard_name' => 'admin'],
            ['name' => 'division-show', 'guard_name' => 'admin'],
            ['name' => 'division-edit', 'guard_name' => 'admin'],
            ['name' => 'division-delete', 'guard_name' => 'admin'],

            ['name' => 'district-list', 'guard_name' => 'admin'],
            ['name' => 'district-create', 'guard_name' => 'admin'],
            ['name' => 'district-show', 'guard_name' => 'admin'],
            ['name' => 'district-edit', 'guard_name' => 'admin'],
            ['name' => 'district-delete', 'guard_name' => 'admin'],

            ['name' => 'upazila-list', 'guard_name' => 'admin'],
            ['name' => 'upazila-create', 'guard_name' => 'admin'],
            ['name' => 'upazila-show', 'guard_name' => 'admin'],
            ['name' => 'upazila-edit', 'guard_name' => 'admin'],
            ['name' => 'upazila-delete', 'guard_name' => 'admin'],

            ['name' => 'work-order-list', 'guard_name' => 'admin'],
            ['name' => 'work-order-create', 'guard_name' => 'admin'],
            ['name' => 'work-order-show', 'guard_name' => 'admin'],
            ['name' => 'work-order-edit', 'guard_name' => 'admin'],
            ['name' => 'work-order-delete', 'guard_name' => 'admin'],

            ['name' => 'report-approve', 'guard_name' => 'admin'],
            ['name' => 'price-show', 'guard_name' => 'admin'],

        ];

        DB::table('permissions')->insert($data);
        //Data for role user pivot
        $data = [
            ['role_id' => 1, 'model_type' => 'App\Models\Admin\Admin', 'model_id' => $dev->id],
            ['role_id' => 2, 'model_type' => 'App\Models\Admin\Admin', 'model_id' => 2],
            ['role_id' => 3, 'model_type' => 'App\Models\Admin\Admin', 'model_id' => 3],
            ['role_id' => 4, 'model_type' => 'App\Models\Admin\Admin', 'model_id' => 4],
            ['role_id' => 5, 'model_type' => 'App\Models\Admin\Admin', 'model_id' => 5],
            ['role_id' => 6, 'model_type' => 'App\Models\Admin\Admin', 'model_id' => 6],
            ['role_id' => 7, 'model_type' => 'App\Models\Admin\Admin', 'model_id' => 7],
            ['role_id' => 8, 'model_type' => 'App\Models\Admin\Admin', 'model_id' => 8],
            ['role_id' => 9, 'model_type' => 'App\Models\Admin\Admin', 'model_id' => 9],
            ['role_id' => 10, 'model_type' => 'App\Models\Admin\Admin', 'model_id' => 10],
        ];
        DB::table('model_has_roles')->insert($data);
        //Data for role permission pivot
        // $permissions = Permission::all();
        // foreach ($permissions as $key => $value) {
        //     $data = [
        //         ['permission_id' => $value->id, 'role_id' => 1],
        //     ];

        //     DB::table('role_has_permissions')->insert($data);

        // }

        
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