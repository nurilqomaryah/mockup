<?php

namespace App\Http\Controllers\Admin\MappingPBJ;

use App\Http\Controllers\Controller;
use App\Models\AnggaranPKAU;
use App\Models\MappingPBJ;
use App\Models\PermintaanPBJ;
use App\Models\RefIndex;
use App\Models\RefPKAU;
use Carbon\Carbon;
use Illuminate\Contracts\View\View;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class CreateMappingPBJ extends Controller
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

    /**
     * Digunakan untuk menampilkan form create mapping ST
     * @return View
     */
    public function viewCreateMappingPBJ(): View
    {
        $listPBJ = $this->permintaanPBJ->getAvailablePBJ();
        $listAnggaran = $this->pkauAnggaran->getPKAUAnggaran();
        return view('crud.mapping_pbj.create_mappingpbj', compact('listPBJ','listAnggaran'));
    }

    /**
     * Dugunakan untuk menyimpan data realisasi IKK
     * @param Request $request
     * @return RedirectResponse
     */
    public function onSubmitCreateMappingPBJ(Request $request): RedirectResponse
    {
        // Validation
        $request->validate([
            'id-pbj'=>'required',
            'id-anggaran'=>'required'
        ]);

        // Get Post Data
        $idPBJ = $request->post('id-pbj');
        $idAnggaran = $request->post('id-anggaran');

        $this->mappingPBJ->id_permintaan_pbj = $idPBJ;
        $this->mappingPBJ->id_anggaran_pkau = $idAnggaran;
        $result = $this->mappingPBJ->save();

        if($result)
            return redirect()
                ->route('mapping_pbj.index')
                ->with('success', 'Mapping PBJ saved!');

        return redirect()
            ->route('mapping_pbj.create')
            ->with('error','Gagal melakukan save mapping PBJ');
    }

}
