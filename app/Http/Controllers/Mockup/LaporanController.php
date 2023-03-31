<?php

namespace App\Http\Controllers\Mockup;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Cookie;
use App\Models\Sima\SuratTugas;
use App\Models\Sima\SuratTugasTim;
use App\Models\Satker;
use App\Models\RefPegawai;
use Carbon\Carbon;

class LaporanController extends Controller
{
    public function viewDashboard()
    {
        $kodeSatker = Satker::select('key_sort_unit','kode_satker')->where('key_sort_unit', Auth::user()->key_sort_unit)->first();
        $now = Carbon::now();

        if($kodeSatker) {
            $listBidang = DB::connection('dbbisma')
                ->table('t_unitkerja')
                ->select('id','nama_unit')
                ->whereRaw('LENGTH(map_unitkerja) = 17')
                ->where('satker_id', $kodeSatker->kode_satker)
                ->get();

            $now = Carbon::now();

            return View::make('laporan.dashlap')
                ->with(compact('listBidang','now'));
        }
    }    

}
