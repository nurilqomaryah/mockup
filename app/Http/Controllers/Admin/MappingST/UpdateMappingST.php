<?php

namespace App\Http\Controllers\Admin\MappingST;

use App\Http\Controllers\Controller;
use App\Models\AnggaranPKAU;
use App\Models\MappingST;
use App\Models\RefIndex;
use App\Models\RefPKAU;
use App\Models\SimaST;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

class UpdateMappingST extends Controller
{
    protected $refPKAU;
    protected $refIndex;
    protected $simaST;
    protected $pkauAnggaran;
    protected $mappingST;

    public function __construct()
    {
        $this->refPKAU = new RefPKAU();
        $this->refIndex = new RefIndex();
        $this->simaST = new SimaST();
        $this->pkauAnggaran = new AnggaranPKAU();
        $this->mappingST = new MappingST();
    }

    public function viewUpdateMappingST(Request $request)
    {
        $idMappingST = $request->route('idMappingST');
        $dataMappingST = $this->mappingST->find($idMappingST);
        $listPenugasan = $this->simaST->all();
        $listAnggaran = $this->pkauAnggaran->all();
        return view('crud.mapping_st.edit_mappingst', compact('dataMappingST','listPenugasan','listAnggaran'));
    }

    public function onSubmitUpdateMappingST(Request $request)
    {
        // Validaton
        $request->validate([
            'id-mapping-st' => 'required',
            'id-st'=>'required',
            'id-anggaran'=>'required'
        ]);

        $idMappingST = $request->post('id-mapping-st');
        $idST = $request->post('id-st');
        $idAnggaran = $request->post('id-anggaran');

        $mappingST = $this->mappingST->find($idMappingST);
        $mappingST->id_st = $idST;
        $mappingST->id = $idAnggaran;

        $result = $mappingST->save();

        if($result)
            return redirect()
                ->route('mappingst.index')
                ->with('success', 'Mapping ST berhasil terupdate!');

        return redirect()
            ->route('realikk.update')
            ->with('error','Gagal melakukan edit mapping ST');
    }

}
