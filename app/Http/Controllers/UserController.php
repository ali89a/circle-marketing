<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Role;
use Brian2694\Toastr\Facades\Toastr;
use DB;

class UserController extends Controller
{
    public function index()
    {
        $data = [
            'users' => User::latest()->get(),
        ];
        return view('admin.access_control.user.index', $data);
    }


    public function create()
    {
        $data = [
            'model' => new User(),
            'roles' => Role::where('name', '!=', 'Super Admin')->pluck('name', 'id'),
        ];

        return view('admin.access_control.user.create', $data);
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required|string|min:8|confirmed'
        ]);

        try {
            DB::beginTransaction();
            $user = new User();
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

    public function show(User $user)
    {

        $data = [
            'model' => $user,
        ];
        return view('admin.users.show', $data);
    }


    public function edit(User $user)
    {
        $data = [
            'user' => $user,
            'roles' => Role::where('name', '!=', 'Super Admin')->pluck('name', 'id'),
            'selected_roles' => Role::whereIn('name', $user->getRoleNames())->pluck('id')
        ];
        return view('admin.access_control.user.edit', $data);
    }


    public function update(Request $request, User $user)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users,email,' . $user->id,
            /* 'password' => 'required|string|min:8|confirmed',*/
        ]);

        try {
            DB::beginTransaction();
            $user->name = $request->name;
            $user->email = $request->email;
            if($request->get('password')){
                $user->password=bcrypt($request->get('password'));
            }
            $user->save();
            $user->syncRoles($request->get('roles'));
            DB::commit();
            Toastr::success('User Updated Successfully!.', '', ["progressbar" => true]);
            return redirect()->route('user.index');
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
        $user = User::findOrFail($id);
        $user->delete();
        Toastr::success('User Deleted Successfully!.', '', ["progressbar" => true]);
        return redirect()->back();
    }
    public function reset($id){
        $user = User::findOrFail($id);
        $user->password=bcrypt('123456789');
        $user->update();

        if ($user) { ;
            Mail::to($user->email)->send(
                new PasswordReset($user)
            );
        }
        Toastr::success('User Reset Successfully!.', '', ["progressbar" => true]);
        return redirect()->back();
    }
}
