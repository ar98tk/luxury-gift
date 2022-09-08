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

    public function showLoginForm()
    {
        return view('admin.auth.login');
    }
    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/home';


    public function login(Request $request)
    {
        $this->validate($request, [
            'email' => 'required|email',
            'password' => 'required'
        ]);
        if (auth('admin')->attempt(['email' => $request->email, 'password' => $request->password])) {
            if (auth('admin')->user()->role == 'Admin')
            {
                return redirect('/home');
            } elseif(auth('admin')->user()->role == 'Moderator')
            {
                return redirect('/moderator/home');
            }
        } else {
            return redirect()->back()->withErrors(['msg' => 'Your Email Or Password isn\'t Correct.']);
        }
    }

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    protected function guard()
    {
        return Auth::guard('admin');
    }
}
