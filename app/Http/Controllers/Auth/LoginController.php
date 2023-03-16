<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

class LoginController extends Controller
{


    use AuthenticatesUsers;


    // protected $redirectTo = RouteServiceProvider::HOME;

    protected function authenticated()
    {
        if (Auth::user()->role_as == '1') {
            return redirect('admin/dashboard')->with('message', 'Welcome to Dashboard!');
        } else {
            return redirect('/home')->with('status', 'Logged In Successfully!');
        }
    }


    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }
}