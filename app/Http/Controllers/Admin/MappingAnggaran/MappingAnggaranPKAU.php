<?php

namespace App\Http\Controllers\Admin\MappingAnggaran;

use App\Http\Controllers\Controller;
use App\Models\AnggaranPKAU;
use App\Models\Pagu;
use App\Models\RefIndex;
use App\Models\RefPKAU;
use Illuminate\Contracts\View\View;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class MappingAnggaranPKAU extends Controller
{
    protected $refIndex;
    protected $refPKAU;
    protected $pagu;
    protected $anggaranPKAU;

    public function __construct()
    {
        $this->refIndex = new RefIndex();
        $this->refPKAU = new RefPKAU();
        $this->pagu = new Pagu();
        $this->anggaranPKAU = new AnggaranPKAU();
    }


    public function viewMappingAnggaran(Request $request)
    {
        $idAnggaranPKAU = $request->route('idAnggaranPKAU');
        $dataAnggaranPKAU = $this->anggaranPKAU->find($idAnggaranPKAU);
        $listReferensiIndex = $this->refIndex->all();
        $dataPagu = $this->pagu->all();
        $dataPKAU = $this->refPKAU->all();

        return view('crud.anggaran_pkau.mapping_anggaran', compact('dataAnggaranPKAU','listReferensiIndex','dataPagu','dataPKAU'));
    }

    /**
     * Dugunakan untuk menyimpan data realisasi IKK
     * @param Request $request
     * @return RedirectResponse
     */
    public function onSubmitMappingAnggaran(Request $request): RedirectResponse
    {
        // Validation
        $request->validate([
            'kd-index'=>'required',
            'nama-pkau'=>'required',
            'nilai-pkau'=>'required'
        ]);

        // Get Post Data
        $kdIndex = $request->post('kd-index');
        $namaPKAU = $request->post('nama-pkau');
        $nilaiPkau = $request->post('nilai-pkau');

        $this->anggaranPKAU->kdindex = $kdIndex;
        $this->anggaranPKAU->nama_pkau = $namaPKAU;
        $this->anggaranPKAU->nilai_pkau = $nilaiPkau;

        $result = $this->anggaranPKAU->save();

        if($result)
            return redirect()
                ->route('mapping_anggaran.mapping_anggaranpkau')
                ->with('success', 'Mapping Anggaran PKAU berhasil!');

        return redirect()
            ->route('mapping_anggaran.mapping_anggaranpkau')
            ->with('error','Gagal melakukan mapping anggaran PKAU');
    }


}
