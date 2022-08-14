<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\RegisterUsersRequest;
use App\Models\Users;
use Illuminate\Http\Request;

class RegisterController extends Controller
{
    private $users;

    public function __construct()
    {
        $this->users = new Users();
    }

    public function viewRegisterUser()
    {
        return view("auth.register");
    }

    public function onSubmitRegisterUser(RegisterUsersRequest $request)
    {
        $username = $request->post('username');
        $password = $request->post('password');
        $encryptedPassword = sha1(md5($password));

        $this->users->username = $username;
        $this->users->password = $encryptedPassword;
        $result = $this->users->save();

        if($request)
            return redirect()
                ->route('login')
                ->with('success','Berhasil register. Silahkan login');

        return redirect()
            ->route('register')
            ->with('error','Terdapat error');
    }
}
