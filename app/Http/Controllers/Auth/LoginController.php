<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Auth;

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
    // protected $redirectTo = '/home';

    protected function redirectTo()
    {
        $role = Auth::user()->is_admin;
        if ($role == 1) {
            return '/admin';
        } else {
            return '/';
        }
        // switch ($role) {
        //     case '1':
        //         return '/admin/dashboard';
        //     case 'Petugas':
        //         return '/petugas/dashboard';
        //     case 'Masyarakat':
        //         return '/beranda';
        //     default:
        //         return '/home'; // Default jika role tidak dikenal
        // }
    }


    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
        $this->middleware('auth')->only('logout');
    }
}
