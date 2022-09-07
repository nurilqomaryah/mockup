<?php

namespace App\Http\Controllers\;

use App\Http\Controllers\Controller;
use App\Models\RefIKK;
use App\Models\PenyerapanAnggaran;
use App\Models\RefPKAU;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\View;

class GrafikPegawai extends Controller
{
    protected $ikk;
    protected $penyerapanangg;
    protected $pkau;

    public function __construct()
    {
        $this->ikk = new RefIKK();
        $this->penyerapanangg = new PenyerapanAnggaran();
        $this->pkau = new RefPKAU();
    }

    public function chart()
    {
        $result = \DB::table('stocks')
            ->where('stockName','=','Infosys')
            ->orderBy('stockYear', 'ASC')
            ->get();
        return response()->json($result);
    }

}
