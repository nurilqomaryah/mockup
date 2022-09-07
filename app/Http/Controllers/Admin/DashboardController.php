<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\MappingST;
use App\Models\RefIKK;
use App\Models\PenyerapanAnggaran;
use App\Models\RefPKAU;
use Illuminate\Support\Facades\View;

class DashboardController extends Controller
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

    public function viewDashboard()
    {

        $listIKK = $this->ikk->getTargetAndRealisasi();
        $penyerapanAnggaran = $this->penyerapanangg->getPenyerapanAnggaran();
        $listPKAU = $this->pkau->getPKAU();

        return View::make('dashboard.dash')
            ->with(compact('listIKK','penyerapanAnggaran','listPKAU'));
    }

}
