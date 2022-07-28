<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Models\Referensi\Users;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Hash;

class LoginController extends Controller
{

    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    public function username()
    {
        return 'username';
    }

    public function index()
    {
        return view('login');
    }

    public function onSubmit(Request $request)
    {
        $username = $request->input('username');
        $password = $request->input('password');

        $user = new User();
        $result = $user->checkUser($username);

        if(count($result)>0)
        {
            if(Hash::check($password, $result[0]->password))
            {
                $request->session()->put('id_user', $result[0]->id_user);
                $request->session()->put('role',$result[0]->id_role);
                $request->session()->put('nama', $result[0]->nama_user);
                if($result[0]->id_role == 1)
                {
                    return redirect()
                        ->route('dashboardadmin');
                }
                else
                {
                    echo $result[0]->id_role;
                    // Redirect ke halaman author
                    return redirect()
                        ->route('dashboardauthor');
                }
            }
            else
            {
                return redirect('/login')->with('error','Password salah');
            }
        }
        else{
            return redirect('/login')->with('error','User tidak ditemukan');
        }
    }

}
