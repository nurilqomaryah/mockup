<?php

namespace App\Http\Controllers\Admin;
use App\Models\Users;
use Illuminate\Contracts\View\View;
use Illuminate\Database\Eloquent\Model;
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
use App\Models\RefIKK;
use App\Models\RealIKK;
use Illuminate\Support\Facades\Hash;


class RealIKKController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $realikk = DB::table('ref_ikk')
            ->select('ref_ikk.id_ikk','ref_ikk.kd_ikk','ref_ikk.nama_ikk','ref_ikk.target','trx_real_ikk.realisasi')
            ->join('trx_real_ikk', 'ref_ikk.id_ikk', '=', 'trx_real_ikk.id_ikk')
            ->get();

        return view('crud.real_ikk.index', compact('realikk'));

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return View
     */
    public function create()
    {
        $data['id_real_ikk'] = DB::table('trx_real_ikk')
            ->get();

        $data['id_ikk'] = DB::table('ref_ikk')
            ->get();


        $data['listBulan'] = [];

        for ($m=1; $m<=12; $m++) {
            $data['listBulan'][] = date('F', mktime(0,0,0,$m, 1, date('Y')));
        }

        return view('crud.real_ikk.createrealikk', $data);

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
            'id_ikk'=>'required',
            'realisasi'=>'required'
        ]);


        $realikk = new RealIKK([
            'id_ikk' => $request->get('id_ikk'),
            'tahun' => $request->get('tahun'),
            'bulan' => $request->get('bulan'),
            'realisasi' => $request->get('realisasi'),
        ]);

        $realikk->save();
        return redirect()
            ->route('realikk.index')
            ->with('success', 'Realisasi IKK saved!');
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
        $this->data['real_ikk'] = DB::table('trx_real_ikk')
            ->get();

        $this->data['edit_realikk'] = RealIKK::find($id);

        return view('crud.real_ikk.editrealikk', $this->data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return RedirectResponse
     */
    public function update(Request $request): RedirectResponse
    {
        $request->validate([
            'id_ikk'=>'required',
            'realisasi'=>'required'
        ]);

        $id = $request->post('id');

        $realikk = RealIKK::find($id);
        $realikk->id_ikk = $request->post('id_ikk');
        $realikk->tahun = $request->post('tahun');
        $realikk->bulan = $request->post('bulan');
        $realikk->realisasi = $request->post('realisasi');
        $realikk->save();

        return redirect()->route('realikk.index')->with('success', 'Realisasi IKK updated!');
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return RedirectResponse
     */
    public function destroy($id): RedirectResponse
    {
        RefIKK::where('id_ikk',$id)->delete();
        return redirect()->route('realikk.index')->with('success', 'Realisasi IKK deleted!');
    }

}
