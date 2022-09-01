<?php

namespace App\Http\Controllers\Admin\RealIKK;

use App\Http\Controllers\Controller;
use App\Models\RealIKK;
use App\Models\RefIKK;
use Carbon\Carbon;
use Illuminate\Contracts\View\View;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class CreateRealIKK extends Controller
{
    protected $refIKK;
    protected $realisasiIKK;

    public function __construct()
    {
        $this->refIKK = new RefIKK();
        $this->realisasiIKK = new RealIKK();
    }

    /**
     * Digunakan untuk menampilkan form create realisasi IKK
     * @return View
     */
    public function viewCreateRealIKK(): View
    {
        $listReferensiIKK = $this->refIKK->all();
        $listBulan = $this->__generateListBulan();
        return view('crud.real_ikk.create_realikk', compact('listReferensiIKK','listBulan'));
    }

    /**
     * Dugunakan untuk menyimpan data realisasi IKK
     * @param Request $request
     * @return RedirectResponse
     */
    public function onSubmitCreateRealIKK(Request $request): RedirectResponse
    {
        // Validation
        $request->validate([
            'id-ikk'=>'required',
            'realisasi'=>'required'
        ]);

        // Get Post Data
        $idIKK = $request->post('id-ikk');
        $bulan = $request->post('bulan');
        $realisasi = $request->post('realisasi');

        // Generate Tahun
        $tahun = Carbon::now()->format('Y');

        $this->realisasiIKK->id_ikk = $idIKK;
        $this->realisasiIKK->tahun = $tahun;
        $this->realisasiIKK->bulan = $bulan;
        $this->realisasiIKK->realisasi = $realisasi;
        $result = $this->realisasiIKK->save();

        if($result)
            return redirect()
                ->route('realikk.index')
                ->with('success', 'Realisasi IKK saved!');

        return redirect()
            ->route('realikk.create')
            ->with('error','Gagal melakukan save data IKK');
    }

    /**
     * Digunakan untuk melakukan generate bulan
     * @return array
     */
    private function __generateListBulan()
    {
        $data = [];

        for ($m=1; $m<=12; $m++) {
            $data[] = date('F', mktime(0,0,0,$m, 1, date('Y')));
        }

        return $data;
    }
}
