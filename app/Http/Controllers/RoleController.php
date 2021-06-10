<?php

namespace App\Http\Controllers;

use DB;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RoleController extends Controller
{
    public function index()
    {
        $data = [
            'roles' => Role::latest('id')->get(),
        ];
        return view('admin.access_control.role.index', $data);
    }

    public function create()
    {

        $data = [
            'model' => new Role,
            'permission' => Permission::get(),
        ];

        return view('admin.access_control.role.create', $data);

    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|unique:roles,name',
            'permission' => 'required',
        ]);

        $role = Role::create(['name' => $request->input('name')]);
        $role->syncPermissions($request->input('permission'));

        \Toastr::success('Role Information Created Successfully!.', '', ["progressbar" => true]);
        return redirect()->route('role.index');
    }

    public function show($id)
    {
        //
    }

    public function edit(Role $role)
    {

        $data = [
            'model' => $role,
            'permission' => Permission::get(),
            'rolePermissions' => DB::table("role_has_permissions")->where("role_has_permissions.role_id", $role->id)
                ->pluck('role_has_permissions.permission_id', 'role_has_permissions.permission_id')
                ->all(),

        ];
        return view('admin.access_control.role.edit', $data);
    }

    public function update(Request $request, Role $role)
    {
        $request->validate([
            'name' => 'required|unique:roles,name,' . $role->id,
        ]);

        $role->name = $request->input('name');
        $role->save();

        $role->syncPermissions($request->input('permission'));

        \Toastr::success('Role Information crated Successfully!.', '', ["progressBar" => true]);
        return redirect()->route('role.index');
    }

    public function destroy($id)
    {
        $role = Role::findOrFail($id);
        $role->delete();
        \Toastr::success('Role Deleted Successfully!.', '', ["progressBar" => true]);
        return redirect()->back();

    }
}
