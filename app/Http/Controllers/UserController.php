<?php

namespace App\Http\Controllers;

use App\Models\Role;
use App\Models\User;
use App\Models\Admin\Admin;
use App\Helpers\LogActivity;
use Illuminate\Http\Request;
use App\Events\CustomerPassword;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

class UserController extends Controller
{
    function __construct()
    {
        $this->middleware('permission:customer-list|customer-create|customer-edit|customer-delete', ['only' => ['index', 'show']]);
        $this->middleware('permission:customer-create', ['only' => ['create', 'store']]);
        $this->middleware('permission:customer-edit', ['only' => ['edit', 'update']]);
        $this->middleware('permission:customer-delete', ['only' => ['destroy']]);
    }
    public function index()
    {

        if (Auth::guard('admin')->user()->hasRole('Marketing Executive')) {
            $user = User::where('marketing_user_id', Auth::guard('admin')->user()->id)->latest()->get();
        }
        else if (Auth::guard('admin')->user()->hasRole('Accounts Executive')) {
            $user = User::where('accounts_user_id', Auth::guard('admin')->user()->id)->latest()->get();
        } else {
            $user = User::latest()->get();
        }
        // dd(Auth::guard('admin')->user()->hasRole('Marketing Executive'));

        $data = [
            'users' =>  $user,
        ];
        return view('admin.customer.index', $data);
    }


    public function create()
    {

        $data = [
            'model' => new User(),
            'marketing_users' => Admin::role(['Marketing Executive', 'Marketing Admin'])->get(),
            'accounts_users' => Admin::role(['Accounts Executive', 'Accounts Admin'])->get()
        ];

        return view('admin.customer.create', $data);
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => ['required'],
            'email' => ['required', 'unique:users', 'max:255'],
            'mobile' => ['required', 'unique:users', 'max:255'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'img_url.*' => 'mimes:jpg,jpeg,png,bmp,gif,svg,webp,pdf|max:1024',
            'btrc_license_url' => 'required | mimes:jpg,jpeg,png,bmp,gif,svg,webp,pdf| max:2048',
            'nid_url' => 'required | mimes:jpg,jpeg,png,bmp,gif,svg,webp,pdf| max:2048',
            'trade_license_url' => 'required | mimes:jpg,jpeg,png,bmp,gif,svg,webp,pdf| max:2048',
            'contact_authorization_url' => 'required | mimes:jpg,jpeg,png,bmp,gif,svg,webp,pdf| max:2048',
        ]);

        // try {
        //     DB::beginTransaction();

        $user = new User();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->mobile = $request->mobile;
        $user->bin_no = $request->bin_no;
        $user->billing_address = $request->billing_address;
        $user->creator_user_id =  Auth::guard('admin')->id();
        $user->marketing_user_id =  $request->marketing_user_id ? $request->marketing_user_id : Auth::guard('admin')->id();
        $user->accounts_user_id =  $request->accounts_user_id ? $request->accounts_user_id : Auth::guard('admin')->id();

        $user->password = bcrypt($request->password);
        if ($request->img_url != null) {
            $fileName = time() . '.' . $request->img_url->extension();
            $request->img_url->move(storage_path('app/public/customer'), $fileName);
            $user->img_url = $fileName;
        }
        if ($request->btrc_license_url != null) {
            $fileName = time() . '.' . $request->btrc_license_url->extension();
            $request->btrc_license_url->move(storage_path('app/public/btrc_license'), $fileName);
            $user->btrc_license_url = $fileName;
        }
        if ($request->nid_url != null) {
            $fileName = time() . '.' . $request->nid_url->extension();
            $request->nid_url->move(storage_path('app/public/nid'), $fileName);
            $user->nid_url = $fileName;
        }
        if ($request->trade_license_url != null) {
            $fileName = time() . '.' . $request->trade_license_url->extension();
            $request->trade_license_url->move(storage_path('app/public/trade_license'), $fileName);
            $user->trade_license_url = $fileName;
        }
        if ($request->contact_authorization_url != null) {
            $fileName = time() . '.' . $request->contact_authorization_url->extension();
            $request->contact_authorization_url->move(storage_path('app/public/contact_authorization'), $fileName);
            $user->contact_authorization_url = $fileName;
        }
        $user->save();

        // $details = [
        //     'title' => 'Mail from Circle Network',
        //     'body' => "Username:$request->email,Password:$request->password"
        // ];

        // Mail::to($request->email)->send(new \App\Mail\CustomerMail($details));
        //DB::commit();

        Toastr::success('Customer Created Successfully!.', '', ["progressbar" => true]);
        return redirect()->route('user.index');

        // } catch (\Exception $e) {
        //     DB::rollBack();
        //     Log::emergency("File:" . $e->getFile() . "Line:" . $e->getLine() . "Message:" . $e->getMessage());
        //     Toastr::info('Something went wrong!.', '', ["progressbar" => true]);
        //     return back();
        // }
    }

    public function show(User $user)
    {

        $data = [
            'model' => $user,
        ];
        return view('admin.customer.show', $data);
    }


    public function edit(User $user)
    {
        $data = [
            'user' => $user,
        ];
        return view('admin.customer.edit', $data);
    }


    public function update(Request $request, User $user)
    {
        $request->validate([
            'name' => ['required'],
            'email' => ['required', 'unique:users,email,' . $user->id],
            'mobile' => ['required', 'unique:users,mobile,' . $user->id],
        ]);

        // try {
        //     DB::beginTransaction();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->mobile = $request->mobile;
        $user->bin_no = $request->bin_no;
        $user->billing_address = $request->billing_address;
        $user->updator_user_id = Auth::guard('admin')->id();
        if ($request->get('password')) {
            $user->password = bcrypt($request->get('password'));
        }
        if ($request->img_url != null) {
            $fileName = time() . '.' . $request->img_url->extension();
            $request->img_url->move(storage_path('app/public/customer'), $fileName);
            $user->img_url = $fileName;
        }
        if ($request->btrc_license_url != null) {
            $fileName = time() . '.' . $request->btrc_license_url->extension();
            $request->btrc_license_url->move(storage_path('app/public/btrc_license'), $fileName);
            $user->btrc_license_url = $fileName;
        }
        if ($request->nid_url != null) {
            $fileName = time() . '.' . $request->nid_url->extension();
            $request->nid_url->move(storage_path('app/public/nid'), $fileName);
            $user->nid_url = $fileName;
        }
        if ($request->trade_license_url != null) {
            $fileName = time() . '.' . $request->trade_license_url->extension();
            $request->trade_license_url->move(storage_path('app/public/trade_license'), $fileName);
            $user->trade_license_url = $fileName;
        }
        if ($request->contact_authorization_url != null) {
            $fileName = time() . '.' . $request->contact_authorization_url->extension();
            $request->contact_authorization_url->move(storage_path('app/public/contact_authorization'), $fileName);
            $user->contact_authorization_url = $fileName;
        }
        if ($user->isDirty()) {
            $user->save();
            //  DB::commit();
            Toastr::success('Customer Updated Successfully!.', '', ["progressbar" => true]);
            return redirect()->route('user.index');
        } else {
            Toastr::info('No Change Customer Updated!.', '', ["progressbar" => true]);
            return redirect()->route('user.index');
        }
        $user->save();
        //  DB::commit();
        Toastr::success('Customer Updated Successfully!.', '', ["progressbar" => true]);
        return redirect()->route('user.index');
        // } catch (\Exception $e) {
        //     DB::rollBack();
        //     Log::emergency("File:" . $e->getFile() . "Line:" . $e->getLine() . "Message:" . $e->getMessage());
        //     $output = ['success' => 0,
        //         'msg' => __("messages.something_went_wrong")
        //     ];
        //     Toastr::info('Something went wrong!.', '', ["progressbar" => true]);
        //     return back();
        // }
    }

    public function destroy($id)
    {
        $user = User::findOrFail($id);
        $user->delete();
        Toastr::success('Customer Deleted Successfully!.', '', ["progressbar" => true]);
        return redirect()->back();
    }
}
