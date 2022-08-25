<?php

namespace App\Http\Controllers\Admin\RealIKK;

use App\Http\Controllers\Controller;
use App\Models\RealIKK;
use Illuminate\Contracts\View\View;
use Illuminate\Database\Eloquent\Model;

class IndexRealIKK extends Controller
{
    protected $realisasiIKK;

    public function __construct()
    {
        $this->realisasiIKK = new RealIKK();
    }

    /**
     * Digunakan untuk menampilkan halaman index realisasi IKK
     * @return View
     */
    public function viewIndexRealIKK(): View
    {
        $listRealisasiIKK = $this->realisasiIKK->getRealisasiIKK();
        return view('crud.real_ikk.index', compact('listRealisasiIKK'));
    }
}
