<?php

namespace App\Http\Controllers\Mockup;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Cookie;
use App\Models\Sima\SuratTugas;

class JsonController extends Controller
{
    public function viewStPkau($id)
    {
        $listPkau = SuratTugas::select('id_st',
                'no_surat_tugas',
                'tanggal_surat_tugas',
                'nama_penugasan',
                'tanggal_mulai',
                'tanggal_selesai',
                'status_st',
                )
            ->where('kode_pkau_pkpt',$id)
            ->get();

        return json_encode($listPkau);
    }

}
