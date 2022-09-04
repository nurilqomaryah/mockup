<?php

namespace App\Http\Controllers\Admin\MappingPBJ;

use App\Http\Controllers\Controller;
use App\Models\AnggaranPKAU;
use App\Models\MappingPBJ;
use App\Models\PermintaanPBJ;
use App\Models\RefIndex;
use App\Models\RefPKAU;;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

class UpdateMappingPBJ extends Controller
{
    protected $refPKAU;
    protected $refIndex;
    protected $permintaanPBJ;
    protected $pkauAnggaran;
    protected $mappingPBJ;

    public function __construct()
    {
        $this->refPKAU = new RefPKAU();
        $this->refIndex = new RefIndex();
        $this->permintaanPBJ = new PermintaanPBJ();
        $this->pkauAnggaran = new AnggaranPKAU();
        $this->mappingPBJ = new MappingPBJ();
    }

    public function viewUpdateMappingPBJ(Request $request)
    {
        $idMappingPBJ = $request->route('idMappingPBJ');
        $dataMappingPBJ = $this->mappingPBJ->find($idMappingPBJ);
        $idPbj = $dataMappingPBJ->id_permintaan_pbj;
        $listPBJ = $this->permintaanPBJ->getAvailablePBJAndCurrentPBJ($idPbj);
        $listAnggaran = $this->pkauAnggaran->getPKAUAnggaran();
        return view('crud.mapping_pbj.edit_mappingpbj', compact('dataMappingPBJ','listPBJ','listAnggaran'));
    }

    public function onSubmitUpdateMappingPBJ(Request $request)
    {
        // Validaton
        $request->validate([
            'id-mapping-pbj' => 'required',
            'id-pbj'=>'required',
            'id-anggaran'=>'required'
        ]);

        $idMappingPBJ = $request->post('id-mapping-pbj');
        $idPBJ = $request->post('id-pbj');
        $idAnggaran = $request->post('id-anggaran');

        $idMappingPBJ = $this->mappingPBJ->find($idMappingPBJ);
        $idMappingPBJ->id_permintaan_pbj = $idPBJ;
        $idMappingPBJ->id = $idAnggaran;

        $result = $idMappingPBJ->save();

        if($result)
            return redirect()
                ->route('mapping_pbj.index')
                ->with('success', 'Mapping PBJ berhasil terupdate!');

        return redirect()
            ->route('mapping_pbj.update')
            ->with('error','Gagal melakukan edit mapping PBJ');
    }

}
