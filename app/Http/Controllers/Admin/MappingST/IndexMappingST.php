<?php

namespace App\Http\Controllers\Admin\MappingST;

use App\Http\Controllers\Controller;
use App\Models\MappingST;
use Illuminate\Contracts\View\View;
use Illuminate\Database\Eloquent\Model;

class IndexMappingST extends Controller
{
    protected $mappingST;

    public function __construct()
    {
        $this->mappingST = new MappingST();
    }

    /**
     * Digunakan untuk menampilkan halaman index realisasi IKK
     * @return View
     */
    public function viewIndexMappingST(): View
    {
        $listMappingST = $this->mappingST->getMappingST();
        return view('crud.mapping_st.index', compact('listMappingST'));
    }
}
