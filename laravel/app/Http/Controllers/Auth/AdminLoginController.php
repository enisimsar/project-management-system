<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Auth;
use App\Models\Admin;

class AdminLoginController extends Controller
{
    public function __construct()
    {
        $this->middleware('guest:admin', ['except' => ['logout']]);
    }

    public function showLoginForm()
    {
        return view('auth.admin-login');
    }

    public function login(Request $request)
    {
        // Validate the form data
        $this->validate($request, [
            'email'   => 'required',
            'password' => 'required|min:6'
        ]);

        $admin = Admin::findByEmail($request->email);
        
        // Attempt to log the user in
        if ($admin && password_verify($request->password, $admin->password)) {
            Auth::guard('admin')->login($admin, $request->has('remember'));
            // if successful, then redirect to their intended location
            return redirect()->intended(route('admin.dashboard'));
        }

        return back()->withInput($request->only('email', 'remember'))->withErrors(['email' => 'Your Credentials do not match!!']);
    }

    public function logout()
    {
        Auth::guard('admin')->logout();
        return redirect('/');
    }
}
