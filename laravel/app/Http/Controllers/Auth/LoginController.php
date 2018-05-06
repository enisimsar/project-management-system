<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Auth;
use Illuminate\Http\Request;
use App\Models\ProjectManager as Manager;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;
    

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/manager';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest', ['except' => ['logout', 'userLogout']]);
    }

    public function showLoginForm()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        // Validate the form data
        $this->validate($request, [
            'email' => 'required',
            'password' => 'required|min:6'
        ]);

        $manager = Manager::findByEmail($request->email);
        
        // Attempt to log the user in
        if ($manager && password_verify($request->password, $manager->password)) {
            Auth::login($manager, $request->has('remember'));
            // if successful, then redirect to their intended location
            return redirect()->intended(route('manager.dashboard'));
        }

        return back()->withInput($request->only('email', 'remember'))->withErrors(['email' => 'Your Credentials do not match!!']);
    }

    public function userLogout()
    {
        Auth::guard('web')->logout();
        return redirect('/');
    }
}
