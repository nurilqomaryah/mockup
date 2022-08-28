<?php

namespace App\Http\Controllers\Admin\MappingAnggaran;

use App\Http\Controllers\Controller;
use App\Models\AnggaranPKAU;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

class DeleteMappingAnggaran extends Controller
{
    protected $mappingAnggaran;

    public function __construct()
    {
        $this->mappingAnggaran = new AnggaranPKAU();
    }

    public function onSubmitDeleteMappingAnggaran(Request $request)
    {
        $idAnggaranPKAU = $request->route('idAnggaranPKAU');
        $mappingAnggaran = $this->mappingAnggaran->find($idAnggaranPKAU);
        $result = $mappingAnggaran->delete();

        if($result)
            return redirect()
                ->route('mapping_anggaran.mapping_anggaranpkau')
                ->with('success', 'Berhasil menghapus mapping anggaran PKAU!');

        return redirect()
            ->route('mapping_anggaran.mapping_anggaranpkau')
            ->with('error','Gagal menghapus mapping anggaran PKAU');
    }
}
