<?php

namespace App\Http\Controllers\Admin\MappingST;

use App\Http\Controllers\Controller;
use App\Models\MappingST;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

class DeleteMappingST extends Controller
{
    protected $mappingST;

    public function __construct()
    {
        $this->mappingST = new MappingST();
    }

    public function onSubmitDeleteMappingST(Request $request)
    {
        $idMappingST = $request->route('idMappingST');
        $mappingST = $this->mappingST->find($idMappingST);
        $result = $mappingST->delete();

        if($result)
            return redirect()
                ->route('mappingst.index')
                ->with('success', 'Berhasil menghapus mapping ST');

        return redirect()
            ->route('mappingst.index')
            ->with('error','Gagal menghapus mapping ST');
    }
}
