<?php

namespace App\Http\Controllers\Admin\MappingPBJ;

use App\Http\Controllers\Controller;
use App\Models\MappingPBJ;
use Illuminate\Contracts\View\View;
use Illuminate\Database\Eloquent\Model;

class IndexMappingPBJ extends Controller
{
    protected $mappingPBJ;

    public function __construct()
    {
        $this->mappingPBJ = new MappingPBJ();
    }

    /**
     * Digunakan untuk menampilkan halaman index realisasi IKK
     * @return View
     */
    public function viewIndexMappingPBJ(): View
    {
        $listMappingPBJ = $this->mappingPBJ->getMappingPBJ();
        return view('crud.mapping_pbj.index', compact('listMappingPBJ'));
    }
}
