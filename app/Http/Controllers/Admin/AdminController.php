<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use App\Models\Admin\Admin;
use App\Models\Role;
use Brian2694\Toastr\Facades\Toastr;
use DB;

class AdminController extends Controller
{
    public function index()
    {
        $data = [
            'users' => Admin::latest()->get(),
        ];
        return view('admin.access_control.user.index', $data);
    }


    public function create()
    {
        $data = [
            'model' => new Admin(),
            'roles' => Role::where('name', '!=', 'Super Admin')->pluck('name', 'id'),
        ];

        return view('admin.access_control.user.create', $data);
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:admins',
            'password' => 'required|string|min:8|confirmed'
        ]);

        try {
            DB::beginTransaction();
            $user = new Admin();
            $user->name = $request->name;
            $user->email = $request->email;
            $user->password = bcrypt($request->password);
            $user->save();
            $user->syncRoles($request->get('roles'));
            DB::commit();

            Toastr::success('User Created Successfully!.', '', ["progressbar" => true]);
            return back();

        } catch (\Exception $e) {
            DB::rollBack();
            \Log::emergency("File:" . $e->getFile() . "Line:" . $e->getLine() . "Message:" . $e->getMessage());
            Toastr::info('Something went wrong!.', '', ["progressbar" => true]);
            return back();
        }
    }

    public function show(Admin $admin)
    {

        $data = [
            'model' => $admin,
        ];
        return view('admin.users.show', $data);
    }


    public function edit(Admin $admin)
    {
        $data = [
            'admin' => $admin,
            'roles' => Role::where('name', '!=', 'Super Admin')->pluck('name', 'id'),
            'selected_roles' => Role::whereIn('name', $admin->getRoleNames())->pluck('id')
        ];
        return view('admin.access_control.user.edit', $data);
    }


    public function update(Request $request, Admin $admin)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:admins,email,' . $admin->id,
            /* 'password' => 'required|string|min:8|confirmed',*/
        ]);

        try {
            DB::beginTransaction();
           $admin->name = $request->name;
           $admin->email = $request->email;
            if($request->get('password')){
               $admin->password=bcrypt($request->get('password'));
            }
           $admin->save();
           $admin->syncRoles($request->get('roles'));
            DB::commit();
            Toastr::success('User Updated Successfully!.', '', ["progressbar" => true]);
            return redirect()->route('admin.index');
        } catch (\Exception $e) {
            DB::rollBack();
            \Log::emergency("File:" . $e->getFile() . "Line:" . $e->getLine() . "Message:" . $e->getMessage());
            $output = ['success' => 0,
                'msg' => __("messages.something_went_wrong")
            ];
            Toastr::info('Something went wrong!.', '', ["progressbar" => true]);
            return back();
        }
    }

    public function destroy($id)
    {
        $user = Admin::findOrFail($id);
        $user->delete();
        Toastr::success('User Deleted Successfully!.', '', ["progressbar" => true]);
        return redirect()->back();
    }
}
