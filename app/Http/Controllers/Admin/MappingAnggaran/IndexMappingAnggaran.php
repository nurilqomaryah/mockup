<?php

namespace App\Http\Controllers\Admin\MappingAnggaran;

use App\Http\Controllers\Controller;
use App\Models\AnggaranPKAU;
use App\Models\RefIndex;
use Illuminate\Contracts\View\View;
use Illuminate\Database\Eloquent\Model;

class IndexMappingAnggaran extends Controller
{
    protected $refIndex;
    public function __construct()
    {
        $this->refIndex         = new RefIndex();
    }

    /**
     * Digunakan untuk menampilkan halaman index realisasi IKK
     * @return View
     */
    public function viewIndexMappingAnggaran(): View
    {
        $listIndex = $this->refIndex->getKdIndexForMapping();
        return view('crud.anggaran_pkau.index', compact('listIndex'));
    }
}
