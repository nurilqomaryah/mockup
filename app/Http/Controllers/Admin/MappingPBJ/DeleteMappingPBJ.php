<?php

namespace App\Http\Controllers\Admin\MappingPBJ;

use App\Http\Controllers\Controller;
use App\Models\MappingPBJ;
use App\Models\PermintaanPBJ;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

class DeleteMappingPBJ extends Controller
{
    protected $mappingPBJ;

    public function __construct()
    {
        $this->mappingPBJ = new MappingPBJ();
    }

    public function onSubmitDeleteMappingPBJ(Request $request)
    {
        $idMappingPBJ = $request->route('idMappingPBJ');
        $idMappingPBJ = $this->mappingPBJ->find($idMappingPBJ);
        $result = $idMappingPBJ->delete();

        if($result)
            return redirect()
                ->route('mapping_pbj.index')
                ->with('success', 'Berhasil menghapus mapping PBJ');

        return redirect()
            ->route('mapping_pbj.index')
            ->with('error','Gagal menghapus mapping PBJ');
    }
}
