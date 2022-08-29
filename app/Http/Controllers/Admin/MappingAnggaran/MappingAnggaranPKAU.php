<?php

namespace App\Http\Controllers\Admin\MappingAnggaran;

use App\Http\Controllers\Controller;
use App\Models\AnggaranPKAU;
use App\Models\Pagu;
use App\Models\RefIndex;
use App\Models\RefPKAU;
use Carbon\Carbon;
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

    /**
     * Digunakan untuk menampilkan mapping anggaran
     *
     * @param Request $request
     * @return View
     */
    public function viewMappingAnggaran(Request $request): View
    {
        $idReferensiIndex = $request->route('idReferensiIndex');
        $dataReferensiIndex = $this->refIndex->find($idReferensiIndex);
        $dataPagu = $this->pagu->find($idReferensiIndex);
        $nilaiPkau = $this->anggaranPKAU->getNilaiPKAUByKdIndex($idReferensiIndex);
        $listReferensiIndex = $this->refIndex->all();
        $listMapping = $this->anggaranPKAU->getPKAUAnggaran();
        $listPkau = $this->refPKAU->getAvailablePKAUByKdIndex($idReferensiIndex);

        return view('crud.anggaran_pkau.mapping_anggaranpkau',
            compact('dataReferensiIndex','listReferensiIndex','listMapping','dataPagu','nilaiPkau','listPkau')
        );
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
            'id-pkau'=>'required',
            'nilai-pkau'=>'required'
        ]);

        // Get Post Data
        $kdIndex = $request->post('kd-index');
        $idPkau = $request->post('id-pkau');
        $nilaiPkau = $request->post('nilai-pkau');

        $this->anggaranPKAU->kdindex = $kdIndex;
        $this->anggaranPKAU->id_pkau = $idPkau;
        $this->anggaranPKAU->nilai_pkau = $nilaiPkau;
        $this->anggaranPKAU->tahun = Carbon::now()->format('Y');

        $result = $this->anggaranPKAU->save();

        if($result)
            return redirect()
                ->route('mapping_anggaran.mapping', ['idReferensiIndex'=>$kdIndex])
                ->with('success', 'Mapping Anggaran PKAU berhasil!');

        return redirect()
            ->route('mapping_anggaran.mapping', ['idReferensiIndex'=>$kdIndex])
            ->with('error','Gagal melakukan mapping anggaran PKAU');
    }


}
