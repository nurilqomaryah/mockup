<?php

namespace App\Http\Controllers\Mockup;
 
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Cookie;
use App\Models\Satker;
use App\Models\Sima\SuratTugas;

class DashboardController extends Controller
{
    public function viewDashboard()
    {
        $kodeSatker = Satker::select('key_sort_unit','kode_satker')->where('key_sort_unit', Auth::user()->key_sort_unit)->first();

        if($kodeSatker) {
            $listPkau = SuratTugas::select('kode_pkau_pkpt','uraian_pkau_pkpt',DB::raw('count(id_st) as total_st'))
                ->groupBy('kode_pkau_pkpt')
                ->orderBy('kode_pkau_pkpt')
                ->where('kdsatker', $kodeSatker->kode_satker)
                ->where('sumber_data', 'PKAU')
                ->get();

            $listPkpt = SuratTugas::select('kode_pkau_pkpt','uraian_pkau_pkpt',DB::raw('count(id_st) as total_st'))
                ->groupBy('kode_pkau_pkpt')
                ->orderBy('kode_pkau_pkpt')
                ->where('kdsatker', $kodeSatker->kode_satker)
                ->where('sumber_data', 'PKPT')
                ->get();

            $csr = DB::connection('dbbisma')
                ->table('d_surattugas')
                ->selectRaw('SUM(d_costsheet.biaya) AS realisasi, d_costsheet.kdindex AS pagu_index')
                ->join('d_costsheet', 'd_surattugas.id_st', '=', 'd_costsheet.id_st')
                ->where('d_surattugas.is_aktif', 1)
                ->whereIn('d_costsheet.status_cs', [5, 6, 7, 8, 9])
                ->groupBy('d_costsheet.kdindex');

            $pbjr = DB::connection('dbbisma')
                ->table('t_permintaan_pbj')
                ->selectRaw('SUM(t_permintaan_pbj.jumlah_uang) AS realisasi, t_permintaan_pbj.kdindex AS pagu_index')
                ->where('t_permintaan_pbj.tahun_anggaran', 2023)
                ->whereIn('t_permintaan_pbj.status', [5, 6, 7, 8, 9])
                ->groupBy('t_permintaan_pbj.kdindex');
                
            $gajir = DB::connection('dbbisma')
                ->table('t_gaji')
                ->selectRaw('SUM(t_gaji_detail.nilai) AS realisasi, t_gaji_detail.kdindex AS pagu_index')
                ->join('t_gaji_detail', 't_gaji.id', '=', 't_gaji_detail.gaji_id')
                ->whereIn('t_gaji.status', [5, 6, 7, 8, 9])
                ->where('t_gaji.thang', 2023)
                ->groupBy('t_gaji_detail.kdindex');    

            $total = DB::connection('dbbisma')
                ->table('d_pagu')
                ->selectRaw('d_bagipagu.kdsatker as kdsatker, 
                    SUM(d_pagu.rupiah) AS anggaran,
                    SUM(IFNULL(csr.realisasi, 0)) + SUM(IFNULL(pbjr.realisasi, 0)) + SUM(IFNULL(gajir.realisasi, 0)) AS realisasi 
                    ')
                ->leftJoin('d_bagipagu','d_pagu.kdindex','=','d_bagipagu.kdindex')
                ->leftJoinSub($csr, 'csr', function ($join){
                    $join->on('d_pagu.kdindex', '=', 'csr.pagu_index');
                })
                ->leftJoinSub($pbjr, 'pbjr', function ($join){
                    $join->on(DB::raw("REPLACE(d_pagu.kdindex, ' ', '')"), '=', DB::raw("pbjr.pagu_index"));
                })
                ->leftJoinSub($gajir, 'gajir', function ($join){
                    $join->on(DB::raw("REPLACE(d_pagu.kdindex, ' ', '')"), '=', DB::raw("gajir.pagu_index"));
                })
                ->where('d_bagipagu.kdsatker', '=', $kodeSatker->kode_satker)
                ->where('d_bagipagu.thang', '=', 2023)
                ->groupBy('d_bagipagu.kdsatker')
                ->get();

            $bidang = DB::connection('dbbisma')
                ->table('d_pagu')
                ->selectRaw('d_bagipagu.unit_id as id, 
                    t_unitkerja.nama_unit as nama_unit,
                    SUM(d_pagu.rupiah) AS anggaran,
                    SUM(IFNULL(csr.realisasi, 0)) + SUM(IFNULL(pbjr.realisasi, 0)) + SUM(IFNULL(gajir.realisasi, 0)) AS realisasi 
                    ')
                ->leftJoin('d_bagipagu', 'd_pagu.kdindex', '=', 'd_bagipagu.kdindex')
                ->leftJoin('t_unitkerja', 'd_bagipagu.unit_id', '=', 't_unitkerja.id')
                ->leftJoinSub($csr, 'csr', function ($join){
                    $join->on('d_pagu.kdindex', '=', 'csr.pagu_index');
                })
                ->leftJoinSub($pbjr, 'pbjr', function ($join){
                    $join->on(DB::raw("REPLACE(d_pagu.kdindex, ' ', '')"), '=', DB::raw("pbjr.pagu_index"));
                })
                ->leftJoinSub($gajir, 'gajir', function ($join){
                    $join->on(DB::raw("REPLACE(d_pagu.kdindex, ' ', '')"), '=', DB::raw("gajir.pagu_index"));
                })
                ->where('d_bagipagu.kdsatker', '=', $kodeSatker->kode_satker)
                ->where('d_bagipagu.thang', '=', 2023)
                ->groupBy('d_bagipagu.unit_id')
                ->get();

            return View::make('dashboard.dash')
                ->with(compact('listPkau','listPkpt','bidang','total'));
        }
        
    } 

}
