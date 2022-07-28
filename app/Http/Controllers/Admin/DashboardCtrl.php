<?php

namespace App\Http\Controllers\Admin;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Auth;
use Carbon\Carbon;
use Session;
use \Validator;
use Response;
use Illuminate\Support\Facades\Input;
use Alert;
use PDF;
use App\Models\User;
use App\Models\website\Categories;
use Illuminate\Support\Facades\Hash;


class DashboardCtrl extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

    }

    public function dashadmin()
    {
//        $jumlahberita = DB::table('t_post')
//            ->where('t_post.id_tag','=',3)
//            ->count();
//        $jumlahjurnal = DB::table('t_post')
//            ->where('t_post.id_kategori','=',1)
//            ->count();
//        $jumlahmajalah = DB::table('t_post')
//            ->where('t_post.id_kategori','=',2)
//            ->count();
//        $jumlahartikel = DB::table('t_post')
//            ->where('t_post.id_tag','=',4)
//            ->count();
//        return view('dashboard',compact('jumlahberita','jumlahjurnal','jumlahmajalah','jumlahartikel'));
          return view('dashboard');
    }

    public function dashauthor(Request $request)
    {
        $jumlahberita = DB::table('t_post')
            ->where('t_post.id_tag','=',3)
            ->where('t_post.id_user','=', $request->session()->get('id_user'))
            ->count();
        $jumlahjurnal = DB::table('t_post')
            ->where('t_post.id_kategori','=',1)
            ->where('t_post.id_user','=', $request->session()->get('id_user'))
            ->count();
        $jumlahmajalah = DB::table('t_post')
            ->where('t_post.id_kategori','=',2)
            ->where('t_post.id_user','=', $request->session()->get('id_user'))
            ->count();
        $jumlahartikel = DB::table('t_post')
            ->where('t_post.id_tag','=',4)
            ->where('t_post.id_user','=', $request->session()->get('id_user'))
            ->count();
        return view('dashboard',compact('jumlahberita','jumlahjurnal','jumlahmajalah','jumlahartikel'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {


    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

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
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {

    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {

    }

}
