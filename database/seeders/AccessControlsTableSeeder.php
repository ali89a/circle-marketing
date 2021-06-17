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
                    'name' => 'Guest',
                    'email' => 'guest@gmail.com',
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
            
            ['name' => 'work-order-list', 'guard_name' => 'admin'],
            ['name' => 'work-order-create', 'guard_name' => 'admin'],
            ['name' => 'work-order-show', 'guard_name' => 'admin'],
            ['name' => 'work-order-edit', 'guard_name' => 'admin'],
            ['name' => 'work-order-delete', 'guard_name' => 'admin'],

            ['name' => 'report-approve', 'guard_name' => 'admin'],

        ];

        DB::table('permissions')->insert($data);
        //Data for role user pivot
        $data = [
            ['role_id' => 1, 'model_type' => 'App\Models\Admin\Admin', 'model_id' => $dev->id],
            ['role_id' => 2, 'model_type' => 'App\Models\Admin\Admin', 'model_id' => 2],
            ['role_id' => 3, 'model_type' => 'App\Models\Admin\Admin', 'model_id' => 3],
        ];
        DB::table('model_has_roles')->insert($data);
        //Data for role permission pivot
        $permissions = Permission::all();
        foreach ($permissions as $key => $value) {
            $data = [
                ['permission_id' => $value->id, 'role_id' => 1],
            ];

            DB::table('role_has_permissions')->insert($data);

        }


    }
}