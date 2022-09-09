<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Users;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class LoginController extends Controller
{

    private $users;
    public function __construct()
    {
        $this->users = new Users();
        $this->middleware('guest')->except('logout');
    }

    public function username()
    {
        return 'username';
    }

    public function index()
    {
        return view('auth/login');
    }

    public function onSubmit(Request $request)
    {
        $username = $request->input('username');
        $password = $request->input('password');
        $encryptedPassword = sha1(md5($password));

        $user = $this->users->findUser($username, $encryptedPassword);
        $request->session()->put('access-data-login', $user);

        if(count($user) > 0)
            return redirect()
                ->route('dashboard');

        return redirect()
            ->route('login')
            ->with('error','Users tidak ditemukan');
    }

}
