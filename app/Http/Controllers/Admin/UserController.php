<?php

namespace App\Http\Controllers\Admin;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Auth;
use Carbon\Carbon;
use Session;
use \Validator;
use Response;
use Illuminate\Support\Facades\Input;
use App\Models\Users;
use App\Models\Role;
use Illuminate\Support\Facades\Hash;


class UserController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $users = Users::select('t_users.id','t_users.username','t_users.password','t_users.kd_satker','roles.nama_role')
            ->join('roles', 't_users.role_id', '=', 'roles.id')
            ->get();

        return view('crud.users.index', compact('users'));

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return View
     */
    public function create(): View
    {
        $data['idRole'] = Role::all();
        return view('crud.users.create_user', $data);

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return RedirectResponse
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'id-role'=>'required',
            'username'=>'required',
            'password'=>'required|min:5'
        ]);


        $user = new Users([
            'id_role' => $request->get('id'),
            'username' => $request->get('username'),
            'password' => Hash::make($request->get('password'))
        ]);
        $user->save();

        return redirect()
            ->route('users.index')
            ->with('success', 'User saved!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return View
     */
    public function edit($id): View
    {
        $this->data['role'] = DB::table('roles')
            ->get();

        $this->data['edit_user'] = Users::find($id);

        return view('crud.users.edit_user', $this->data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return RedirectResponse
     */
    public function update(Request $request): RedirectResponse
    {
        $request->validate([
            'id' => 'required',
            'id_role'=>'required',
            'username'=>'required',
            'password'=>'required|min:5'
        ]);

        $id = $request->post('id');

        $user = Users::find($id);
        $user->role_id = $request->post('id_role');
        $user->username = $request->post('username');
        $user->password = Hash::make($request->post('password'));
        $user->save();

        return redirect()->route('users.index')->with('success', 'User updated!');
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return RedirectResponse
     */
    public function destroy($id): RedirectResponse
    {
        Users::where('id',$id)->delete();
        return redirect()->route('users.index')->with('success', 'User deleted!');
    }

}
