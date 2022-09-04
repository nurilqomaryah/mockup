<?php

namespace App\Http\Controllers\Admin\MappingST;

use App\Http\Controllers\Controller;
use App\Models\AnggaranPKAU;
use App\Models\MappingST;
use App\Models\RefIndex;
use App\Models\RefPKAU;
use App\Models\SimaST;
use Carbon\Carbon;
use Illuminate\Contracts\View\View;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class CreateMappingST extends Controller
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

    /**
     * Digunakan untuk menampilkan form create mapping ST
     * @return View
     */
    public function viewCreateMappingST(): View
    {
        $listPenugasan = $this->simaST->getAvailableST();
        $listAnggaran = $this->pkauAnggaran->getPKAUAnggaran();
        return view('crud.mapping_st.create_mappingst', compact('listPenugasan','listAnggaran'));
    }

    /**
     * Dugunakan untuk menyimpan data realisasi IKK
     * @param Request $request
     * @return RedirectResponse
     */
    public function onSubmitCreateMappingST(Request $request): RedirectResponse
    {
        // Validation
        $request->validate([
            'id-st'=>'required',
            'id-anggaran'=>'required'
        ]);

        // Get Post Data
        $idST = $request->post('id-st');
        $idAnggaran = $request->post('id-anggaran');

        $this->mappingST->id_st = $idST;
        $this->mappingST->id_anggaran_pkau = $idAnggaran;
        $result = $this->mappingST->save();

        if($result)
            return redirect()
                ->route('mappingst.index')
                ->with('success', 'Mapping ST saved!');

        return redirect()
            ->route('mappingst.create')
            ->with('error','Gagal melakukan save mapping ST');
    }

}
