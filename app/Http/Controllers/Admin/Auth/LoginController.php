<?php

namespace App\Http\Controllers\Admin\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    use AuthenticatesUsers;
    protected $redirectTo = RouteServiceProvider::ADMINHOME;

    public function __construct()
    {
        $this->middleware('guest:admin')->except('logout');
    }

    /**
     * Show the application's login form.
     */
    public function showLoginForm()
    {
        return view('admin.auth.login');
    }

    // public function login(Request $request)
    // {
    //     return $request->all();
    // }

    /**
     * Log the user out of the application.
     */
    public function logout(Request $request)
    {
        $this->guard()->logout();

        return redirect()->route('admin.login');
    }

    /**
     * Get the guard to be used during authentication.
     */
    protected function guard()
    {
        return Auth::guard('admin');
    }
}