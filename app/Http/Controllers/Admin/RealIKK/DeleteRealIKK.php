<?php

namespace App\Http\Controllers\Admin\RealIKK;

use App\Http\Controllers\Controller;
use App\Models\RealIKK;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

class DeleteRealIKK extends Controller
{
    protected $realisasiIKK;

    public function __construct()
    {
        $this->realisasiIKK = new RealIKK();
    }

    public function onSubmitDeleteRealIKK(Request $request)
    {
        $idRealisasiIKK = $request->route('idRealisasiIKK');
        $realisasiIKK = $this->realisasiIKK->find($idRealisasiIKK);
        $result = $realisasiIKK->delete();

        if($result)
            return redirect()
                ->route('realikk.index')
                ->with('success', 'Realisasi IKK saved!');

        return redirect()
            ->route('realikk.index')
            ->with('error','Gagal melakukan save data IKK');
    }
}
