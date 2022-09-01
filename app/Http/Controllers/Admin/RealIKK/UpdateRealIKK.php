<?php

namespace App\Http\Controllers\Admin\RealIKK;

use App\Http\Controllers\Controller;
use App\Models\RealIKK;
use App\Models\RefIKK;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

class UpdateRealIKK extends Controller
{
    protected $refIKK;
    protected $realisasiIKK;

    public function __construct()
    {
        $this->refIKK = new RefIKK();
        $this->realisasiIKK = new RealIKK();
    }

    public function viewUpdateRealIKK(Request $request)
    {
        $idRealisasiIKK = $request->route('idRealisasiIKK');
        $dataRealisasiIKK = $this->realisasiIKK->find($idRealisasiIKK);
        $dataReferensiIKK = $this->refIKK->find($dataRealisasiIKK->id_ikk);
        $listReferensiIKK = $this->refIKK->all();
        $listBulan = $this->__generateListBulan();
        return view('crud.real_ikk.edit_realikk', compact('dataRealisasiIKK','dataReferensiIKK',
            'listBulan','listReferensiIKK'));
    }

    public function onSubmitUpdateRealIKK(Request $request)
    {
        // Validaton
        $request->validate([
            'id-realisasi-ikk' => 'required',
            'id-ikk'=>'required',
            'realisasi'=>'required'
        ]);

        $idRealisasiIKK = $request->post('id-realisasi-ikk');
        $idIKK = $request->post('id-ikk');
        $bulan = $request->post('bulan');
        $realisasi = $request->post('realisasi');

        $realisasiIKK = $this->realisasiIKK->find($idRealisasiIKK);
        $realisasiIKK->id_ikk = $idIKK;
        $realisasiIKK->bulan = $bulan;
        $realisasiIKK->realisasi = $realisasi;
        $result = $realisasiIKK->save();

        if($result)
            return redirect()
                ->route('realikk.index')
                ->with('success', 'Realisasi IKK saved!');

        return redirect()
            ->route('realikk.update')
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
