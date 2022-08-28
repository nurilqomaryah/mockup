<?php

namespace App\Http\Controllers\Admin\MappingAnggaran;

use App\Http\Controllers\Controller;
use App\Models\AnggaranPKAU;
use Illuminate\Contracts\View\View;
use Illuminate\Database\Eloquent\Model;

class IndexMappingAnggaran extends Controller
{
    protected $mappingAnggaran;

    public function __construct()
    {
        $this->mappingAnggaran = new AnggaranPKAU();
    }

    /**
     * Digunakan untuk menampilkan halaman index realisasi IKK
     * @return View
     */
    public function viewIndexMappingAnggaran(): View
    {
        $listAnggaran = $this->mappingAnggaran->getIndexAnggaran();
        return view('crud.anggaran_pkau.index', compact('listAnggaran'));
    }
}
