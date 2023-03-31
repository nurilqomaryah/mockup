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
use App\Models\Bisma\CostSheet;

class JsonController extends Controller
{
    public function viewStPkau($id)
    {
        $kodeSatker = Cookie::get('satker');

        if ($kodeSatker) {
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

    public function listStSatker($mulai, $selesai) 
    {  
        $kodeSatker = Cookie::get('satker');

        if ($kodeSatker) {
            $tugas = DB::table('r_pegawai')
                ->selectRaw(
                    'r_pegawai.id as id,
                    r_pegawai.nip as nip,
                    r_pegawai.nama as nama,
                    r_pegawai.nm_jabdetail as jabatan,
                    count(t_sima_st.id_st) as jumlah,
                    count(t_sima_st.id_st) as detil
                    '
                    )
                ->leftJoin('t_sima_tim', 'r_pegawai.nip', '=', 't_sima_tim.nip')
                ->leftJoin('t_sima_st', function ($join) use ($mulai, $selesai) {
                        $join->on('t_sima_tim.id_st', '=', 't_sima_st.id_st')
                            ->where('t_sima_st.tanggal_mulai', '<=', $selesai)
                            ->where('t_sima_st.tanggal_selesai', '>=', $mulai);
                    })
                ->where('r_pegawai.key_sort_unit', $kodeSatker)
                ->groupBy('r_pegawai.nip')
                ->orderBy('jumlah', 'desc')            
                ->get();

            return json_encode($tugas);
        }        
    }

    public function listStBidang($id, $mulai, $selesai) 
    {  
        $kodeSatker = Cookie::get('satker');

        if ($kodeSatker) {
            $tugas = DB::table('r_pegawai')
                ->selectRaw(
                    'r_pegawai.id as id,
                    r_pegawai.nip as nip,
                    r_pegawai.nama as nama,
                    r_pegawai.nm_jabdetail as jabatan,
                    count(t_sima_st.id_st) as jumlah,
                    count(t_sima_st.id_st) as detil
                    '
                    )
                ->leftJoin('t_sima_tim', 'r_pegawai.nip', '=', 't_sima_tim.nip')
                ->leftJoin('t_sima_st', function ($join) use ($mulai, $selesai) {
                        $join->on('t_sima_tim.id_st', '=', 't_sima_st.id_st')
                            ->where('t_sima_st.tanggal_mulai', '<=', $selesai)
                            ->where('t_sima_st.tanggal_selesai', '>=', $mulai);
                    })
                ->where('r_pegawai.key_sort_unit', $kodeSatker)
                ->where('r_pegawai.idt_unitkerja', $id)
                ->groupBy('r_pegawai.nip')
                ->orderBy('jumlah', 'desc')           
                ->get();

            return json_encode($tugas);
        }        
    }

    public function viewStPeg($id, $mulai, $selesai) 
    {
        $kodeSatker = Cookie::get('satker');

        if ($kodeSatker) {  
            $tugas = DB::table('t_sima_tim')
                ->selectRaw('t_sima_tim.id_tim as no,
                    t_sima_st.no_surat_tugas as nost,
                    t_sima_st.tanggal_surat_tugas as tglst,
                    t_sima_st.nama_penugasan as urst,
                    t_sima_st.tanggal_mulai as mulai,
                    t_sima_st.tanggal_selesai as selesai'
                    )
                ->join('r_pegawai', 't_sima_tim.nip', '=', 'r_pegawai.nip')
                ->join('t_sima_st', function ($join) use ($mulai, $selesai) {
                        $join->on('t_sima_tim.id_st', '=', 't_sima_st.id_st')
                            ->where('t_sima_st.tanggal_mulai', '<=', $selesai)
                            ->where('t_sima_st.tanggal_selesai', '>=', $mulai);
                    })
                ->where('r_pegawai.id','=', $id)
                ->get();

            return json_encode($tugas);
        }
    }

    public function viewPenyerapanBidang($id) 
    {
        $keySort = Cookie::get('satker');

        $kodeSatker = Satker::select('key_sort_unit','kode_satker')->where('key_sort_unit', $keySort)->first();


        if ($kodeSatker) {
            $cso = DB::connection('dbbisma')
                ->table('d_surattugas')
                ->selectRaw('SUM(d_costsheet.biaya) AS outstand, d_costsheet.kdindex AS pagu_index')
                ->join('d_costsheet', 'd_surattugas.id_st', '=', 'd_costsheet.id_st')
                ->where('d_surattugas.is_aktif', 1)
                ->whereIn('d_costsheet.status_cs', [1, 2, 3, 12, 4])
                ->groupBy('d_costsheet.kdindex');

            $csd = DB::connection('dbbisma')
                ->table('d_surattugas')
                ->selectRaw('SUM(d_costsheet.biaya) AS draft, d_costsheet.kdindex AS pagu_index')
                ->join('d_costsheet', 'd_surattugas.id_st', '=', 'd_costsheet.id_st')
                ->where('d_surattugas.is_aktif', 1)
                ->where('d_costsheet.status_cs', 11)
                ->groupBy('d_costsheet.kdindex');

            $csr = DB::connection('dbbisma')
                ->table('d_surattugas')
                ->selectRaw('SUM(d_costsheet.biaya) AS realisasi, d_costsheet.kdindex AS pagu_index')
                ->join('d_costsheet', 'd_surattugas.id_st', '=', 'd_costsheet.id_st')
                ->where('d_surattugas.is_aktif', 1)
                ->whereIn('d_costsheet.status_cs', [5, 6, 7, 8, 9])
                ->groupBy('d_costsheet.kdindex');

            $pbjo = DB::connection('dbbisma')
                ->table('t_permintaan_pbj')
                ->selectRaw('SUM(t_permintaan_pbj.jumlah_uang) AS outstand, t_permintaan_pbj.kdindex AS pagu_index')
                ->where('t_permintaan_pbj.tahun_anggaran', 2023)
                ->whereIn('t_permintaan_pbj.status', [1, 2, 3, 12, 4])
                ->groupBy('t_permintaan_pbj.kdindex');

            $pbjd = DB::connection('dbbisma')
                ->table('t_permintaan_pbj')
                ->selectRaw('SUM(t_permintaan_pbj.jumlah_uang) AS draft, t_permintaan_pbj.kdindex AS pagu_index')
                ->where('t_permintaan_pbj.tahun_anggaran', 2023)
                ->where('t_permintaan_pbj.status', 11)
                ->groupBy('t_permintaan_pbj.kdindex');

            $pbjr = DB::connection('dbbisma')
                ->table('t_permintaan_pbj')
                ->selectRaw('SUM(t_permintaan_pbj.jumlah_uang) AS realisasi, t_permintaan_pbj.kdindex AS pagu_index')
                ->where('t_permintaan_pbj.tahun_anggaran', 2023)
                ->whereIn('t_permintaan_pbj.status', [5, 6, 7, 8, 9])
                ->groupBy('t_permintaan_pbj.kdindex');

            $gajio = DB::connection('dbbisma')
                ->table('t_gaji')
                ->selectRaw('SUM(t_gaji_detail.nilai) AS outstand, t_gaji_detail.kdindex AS pagu_index')
                ->join('t_gaji_detail', 't_gaji.id', '=', 't_gaji_detail.gaji_id')
                ->whereIn('t_gaji.status', [1, 2, 3, 12, 4])
                ->where('t_gaji.thang', 2023)
                ->groupBy('t_gaji_detail.kdindex');

            $gajid = DB::connection('dbbisma')
                ->table('t_gaji')
                ->selectRaw('SUM(t_gaji_detail.nilai) AS draft, t_gaji_detail.kdindex AS pagu_index')
                ->join('t_gaji_detail', 't_gaji.id', '=', 't_gaji_detail.gaji_id')
                ->where('t_gaji.status', 11)
                ->where('t_gaji.thang', 2023)
                ->groupBy('t_gaji_detail.kdindex');
                
            $gajir = DB::connection('dbbisma')
                ->table('t_gaji')
                ->selectRaw('SUM(t_gaji_detail.nilai) AS realisasi, t_gaji_detail.kdindex AS pagu_index')
                ->join('t_gaji_detail', 't_gaji.id', '=', 't_gaji_detail.gaji_id')
                ->whereIn('t_gaji.status', [5, 6, 7, 8, 9])
                ->where('t_gaji.thang', 2023)
                ->groupBy('t_gaji_detail.kdindex');

            $bidang = DB::connection('dbbisma')
                ->table('d_pagu')
                ->selectRaw('d_bagipagu.unit_id as id, 
                    t_unitkerja.nama_unit as nama_unit,
                    SUM(d_pagu.rupiah) AS anggaran,
                    SUM(IFNULL(cso.outstand, 0)) + SUM(IFNULL(pbjo.outstand, 0)) + SUM(IFNULL(gajio.outstand, 0)) AS outstand,
                    SUM(IFNULL(csd.draft, 0)) + SUM(IFNULL(pbjd.draft, 0)) + SUM(IFNULL(gajid.draft, 0)) AS draft,
                    SUM(IFNULL(csr.realisasi, 0)) + SUM(IFNULL(pbjr.realisasi, 0)) + SUM(IFNULL(gajir.realisasi, 0)) AS realisasi 
                    ')
                ->leftJoin('d_bagipagu', 'd_pagu.kdindex', '=', 'd_bagipagu.kdindex')
                ->leftJoin('t_unitkerja', 'd_bagipagu.unit_id', '=', 't_unitkerja.id')
                ->leftJoinSub($cso, 'cso', function ($join){
                    $join->on('d_pagu.kdindex', '=', 'cso.pagu_index');
                })
                ->leftJoinSub($csd, 'csd', function ($join){
                    $join->on('d_pagu.kdindex', '=', 'csd.pagu_index');
                })
                ->leftJoinSub($csr, 'csr', function ($join){
                    $join->on('d_pagu.kdindex', '=', 'csr.pagu_index');
                })
                ->leftJoinSub($pbjo, 'pbjo', function ($join){
                    $join->on(DB::raw("REPLACE(d_pagu.kdindex, ' ', '')"), '=', DB::raw("pbjo.pagu_index"));
                })
                ->leftJoinSub($pbjd, 'pbjd', function ($join){
                    $join->on(DB::raw("REPLACE(d_pagu.kdindex, ' ', '')"), '=', DB::raw("pbjd.pagu_index"));
                })
                ->leftJoinSub($pbjr, 'pbjr', function ($join){
                    $join->on(DB::raw("REPLACE(d_pagu.kdindex, ' ', '')"), '=', DB::raw("pbjr.pagu_index"));
                })
                ->leftJoinSub($gajio, 'gajio', function ($join){
                    $join->on(DB::raw("REPLACE(d_pagu.kdindex, ' ', '')"), '=', DB::raw("gajio.pagu_index"));
                })
                ->leftJoinSub($gajid, 'gajid', function ($join){
                    $join->on(DB::raw("REPLACE(d_pagu.kdindex, ' ', '')"), '=', DB::raw("gajid.pagu_index"));
                })
                ->leftJoinSub($gajir, 'gajir', function ($join){
                    $join->on(DB::raw("REPLACE(d_pagu.kdindex, ' ', '')"), '=', DB::raw("gajir.pagu_index"));
                })
                ->where('d_bagipagu.unit_id', '=', $id)
                ->where('d_bagipagu.thang', '=', 2023)
                ->get();

            return json_encode($bidang);
        }
    }

    public function viewPenyerapanSatker() 
    {
        $keySort = Cookie::get('satker');

        $kodeSatker = Satker::select('key_sort_unit','kode_satker')->where('key_sort_unit', $keySort)->first();

        if ($kodeSatker) {
            $cso = DB::connection('dbbisma')
                ->table('d_surattugas')
                ->selectRaw('SUM(d_costsheet.biaya) AS outstand, d_costsheet.kdindex AS pagu_index')
                ->join('d_costsheet', 'd_surattugas.id_st', '=', 'd_costsheet.id_st')
                ->where('d_surattugas.is_aktif', 1)
                ->whereIn('d_costsheet.status_cs', [1, 2, 3, 12, 4])
                ->groupBy('d_costsheet.kdindex');

            $csd = DB::connection('dbbisma')
                ->table('d_surattugas')
                ->selectRaw('SUM(d_costsheet.biaya) AS draft, d_costsheet.kdindex AS pagu_index')
                ->join('d_costsheet', 'd_surattugas.id_st', '=', 'd_costsheet.id_st')
                ->where('d_surattugas.is_aktif', 1)
                ->where('d_costsheet.status_cs', 11)
                ->groupBy('d_costsheet.kdindex');

            $csr = DB::connection('dbbisma')
                ->table('d_surattugas')
                ->selectRaw('SUM(d_costsheet.biaya) AS realisasi, d_costsheet.kdindex AS pagu_index')
                ->join('d_costsheet', 'd_surattugas.id_st', '=', 'd_costsheet.id_st')
                ->where('d_surattugas.is_aktif', 1)
                ->whereIn('d_costsheet.status_cs', [5, 6, 7, 8, 9])
                ->groupBy('d_costsheet.kdindex');

            $pbjo = DB::connection('dbbisma')
                ->table('t_permintaan_pbj')
                ->selectRaw('SUM(t_permintaan_pbj.jumlah_uang) AS outstand, t_permintaan_pbj.kdindex AS pagu_index')
                ->where('t_permintaan_pbj.tahun_anggaran', 2023)
                ->whereIn('t_permintaan_pbj.status', [1, 2, 3, 12, 4])
                ->groupBy('t_permintaan_pbj.kdindex');

            $pbjd = DB::connection('dbbisma')
                ->table('t_permintaan_pbj')
                ->selectRaw('SUM(t_permintaan_pbj.jumlah_uang) AS draft, t_permintaan_pbj.kdindex AS pagu_index')
                ->where('t_permintaan_pbj.tahun_anggaran', 2023)
                ->where('t_permintaan_pbj.status', 11)
                ->groupBy('t_permintaan_pbj.kdindex');

            $pbjr = DB::connection('dbbisma')
                ->table('t_permintaan_pbj')
                ->selectRaw('SUM(t_permintaan_pbj.jumlah_uang) AS realisasi, t_permintaan_pbj.kdindex AS pagu_index')
                ->where('t_permintaan_pbj.tahun_anggaran', 2023)
                ->whereIn('t_permintaan_pbj.status', [5, 6, 7, 8, 9])
                ->groupBy('t_permintaan_pbj.kdindex');

            $gajio = DB::connection('dbbisma')
                ->table('t_gaji')
                ->selectRaw('SUM(t_gaji_detail.nilai) AS outstand, t_gaji_detail.kdindex AS pagu_index')
                ->join('t_gaji_detail', 't_gaji.id', '=', 't_gaji_detail.gaji_id')
                ->whereIn('t_gaji.status', [1, 2, 3, 12, 4])
                ->where('t_gaji.thang', 2023)
                ->groupBy('t_gaji_detail.kdindex');

            $gajid = DB::connection('dbbisma')
                ->table('t_gaji')
                ->selectRaw('SUM(t_gaji_detail.nilai) AS draft, t_gaji_detail.kdindex AS pagu_index')
                ->join('t_gaji_detail', 't_gaji.id', '=', 't_gaji_detail.gaji_id')
                ->where('t_gaji.status', 11)
                ->where('t_gaji.thang', 2023)
                ->groupBy('t_gaji_detail.kdindex');
                
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
                    SUM(IFNULL(cso.outstand, 0)) + SUM(IFNULL(pbjo.outstand, 0)) + SUM(IFNULL(gajio.outstand, 0)) AS outstand,
                    SUM(IFNULL(csd.draft, 0)) + SUM(IFNULL(pbjd.draft, 0)) + SUM(IFNULL(gajid.draft, 0)) AS draft,
                    SUM(IFNULL(csr.realisasi, 0)) + SUM(IFNULL(pbjr.realisasi, 0)) + SUM(IFNULL(gajir.realisasi, 0)) AS realisasi 
                    ')
                ->leftJoin('d_bagipagu','d_pagu.kdindex','=','d_bagipagu.kdindex')
                ->leftJoinSub($cso, 'cso', function ($join){
                    $join->on('d_pagu.kdindex', '=', 'cso.pagu_index');
                })
                ->leftJoinSub($csd, 'csd', function ($join){
                    $join->on('d_pagu.kdindex', '=', 'csd.pagu_index');
                })
                ->leftJoinSub($csr, 'csr', function ($join){
                    $join->on('d_pagu.kdindex', '=', 'csr.pagu_index');
                })
                ->leftJoinSub($pbjo, 'pbjo', function ($join){
                    $join->on(DB::raw("REPLACE(d_pagu.kdindex, ' ', '')"), '=', DB::raw("pbjo.pagu_index"));
                })
                ->leftJoinSub($pbjd, 'pbjd', function ($join){
                    $join->on(DB::raw("REPLACE(d_pagu.kdindex, ' ', '')"), '=', DB::raw("pbjd.pagu_index"));
                })
                ->leftJoinSub($pbjr, 'pbjr', function ($join){
                    $join->on(DB::raw("REPLACE(d_pagu.kdindex, ' ', '')"), '=', DB::raw("pbjr.pagu_index"));
                })
                ->leftJoinSub($gajio, 'gajio', function ($join){
                    $join->on(DB::raw("REPLACE(d_pagu.kdindex, ' ', '')"), '=', DB::raw("gajio.pagu_index"));
                })
                ->leftJoinSub($gajid, 'gajid', function ($join){
                    $join->on(DB::raw("REPLACE(d_pagu.kdindex, ' ', '')"), '=', DB::raw("gajid.pagu_index"));
                })
                ->leftJoinSub($gajir, 'gajir', function ($join){
                    $join->on(DB::raw("REPLACE(d_pagu.kdindex, ' ', '')"), '=', DB::raw("gajir.pagu_index"));
                })
                ->where('d_bagipagu.kdsatker', '=', $kodeSatker->kode_satker)
                ->where('d_bagipagu.thang', '=', 2023)
                ->groupBy('d_bagipagu.kdsatker')
                ->get();

            return json_encode($total);
        }
    }

    public function viewPerjadinBidang($id) 
    {
        $keySort = Cookie::get('satker');

        $kodeSatker = Satker::select('key_sort_unit','kode_satker')->where('key_sort_unit', $keySort)->first();

        if ($kodeSatker) {
        
            $cso = DB::connection('dbbisma')
                ->table('d_surattugas')
                ->selectRaw('SUM(d_costsheet.biaya) AS outstand, d_costsheet.kdindex AS pagu_index')
                ->join('d_costsheet', 'd_surattugas.id_st', '=', 'd_costsheet.id_st')
                ->where('d_surattugas.is_aktif', 1)
                ->whereIn('d_costsheet.status_cs', [1, 2, 3, 12, 4])
                ->groupBy('d_costsheet.kdindex');

            $csd = DB::connection('dbbisma')
                ->table('d_surattugas')
                ->selectRaw('SUM(d_costsheet.biaya) AS draft, d_costsheet.kdindex AS pagu_index')
                ->join('d_costsheet', 'd_surattugas.id_st', '=', 'd_costsheet.id_st')
                ->where('d_surattugas.is_aktif', 1)
                ->where('d_costsheet.status_cs', 11)
                ->groupBy('d_costsheet.kdindex');

            $csr = DB::connection('dbbisma')
                ->table('d_surattugas')
                ->selectRaw('SUM(d_costsheet.biaya) AS realisasi, d_costsheet.kdindex AS pagu_index')
                ->join('d_costsheet', 'd_surattugas.id_st', '=', 'd_costsheet.id_st')
                ->where('d_surattugas.is_aktif', 1)
                ->whereIn('d_costsheet.status_cs', [5, 6, 7, 8, 9])
                ->groupBy('d_costsheet.kdindex');            

            $bidang = DB::connection('dbbisma')
                ->table('d_pagu')
                ->selectRaw('
                    d_pagu.kdindex as kdindex,                    
                    d_pagu.kdkmpnen as kdkmpnen,
                    CONCAT(d_pagu.kdkmpnen," - ",d_kmpnen.urkmpnen) as urkmpnen,
                    d_pagu.kdskmpnen as kdskmpnen,
                    CONCAT(d_pagu.kdskmpnen," - ",d_skmpnen.urskmpnen) as urskmpnen,
                    d_pagu.kdakun as kdakun,
                    CONCAT(d_pagu.kdakun," - ",t_akun.nmakun) as nmakun,
                    SUM(d_pagu.rupiah) AS anggaran,
                    SUM(IFNULL(cso.outstand, 0)) AS outstand,
                    SUM(IFNULL(csd.draft, 0)) AS draft,
                    SUM(IFNULL(csr.realisasi, 0)) AS realisasi,
                    SUM(d_pagu.rupiah)-SUM(IFNULL(cso.outstand, 0))-SUM(IFNULL(csd.draft, 0))-SUM(IFNULL(csr.realisasi, 0)) AS sisa
                    ')
                ->leftJoin('d_bagipagu', 'd_pagu.kdindex', '=', 'd_bagipagu.kdindex')
                ->leftJoin('t_unitkerja', 'd_bagipagu.unit_id', '=', 't_unitkerja.id')
                ->join('t_akun', function ($join) {
                    $join->on('d_pagu.kdakun', '=', 't_akun.kdakun');
                    $join->whereIn('d_pagu.kdakun', [524111, 524113, 524114, 524119]);
                })
                ->join('d_soutput', function ($join) {
                    $join->on('d_pagu.kdsoutput', '=', 'd_soutput.kdsoutput');
                    $join->on('d_pagu.kdsatker', '=', 'd_soutput.kdsatker');
                    $join->on('d_pagu.thang', '=', 'd_soutput.thang');
                })
                ->join('d_kmpnen', function ($join) {
                    $join->on('d_pagu.kdkmpnen', '=', 'd_kmpnen.kdkmpnen');
                    $join->on('d_pagu.kdsoutput', '=', 'd_kmpnen.kdsoutput');
                    $join->on('d_pagu.kdsatker', '=', 'd_kmpnen.kdsatker');
                    $join->on('d_pagu.thang', '=', 'd_kmpnen.thang');
                })
                ->join('d_skmpnen', function ($join) {
                    $join->on('d_pagu.kdkmpnen', '=', 'd_skmpnen.kdkmpnen');
                    $join->on('d_pagu.kdskmpnen', '=', 'd_skmpnen.kdskmpnen');
                    $join->on('d_pagu.kdsatker', '=', 'd_skmpnen.kdsatker');
                    $join->on('d_pagu.thang', '=', 'd_skmpnen.thang');
                })                  
                ->leftJoinSub($cso, 'cso', function ($join){
                    $join->on('d_pagu.kdindex', '=', 'cso.pagu_index');
                })
                ->leftJoinSub($csd, 'csd', function ($join){
                    $join->on('d_pagu.kdindex', '=', 'csd.pagu_index');
                })
                ->leftJoinSub($csr, 'csr', function ($join){
                    $join->on('d_pagu.kdindex', '=', 'csr.pagu_index');
                })                
                ->where('d_bagipagu.unit_id', '=', $id)
                ->where('d_bagipagu.thang', '=', 2023)
                ->groupBy('d_pagu.kdindex')
                ->get();

            return json_encode($bidang);

        }
        
    }

    public function viewStatusCsDraft($id) 
    {
        $keySort = Cookie::get('satker');

        $kodeSatker = Satker::select('key_sort_unit','kode_satker')->where('key_sort_unit', $keySort)->first();

        if ($kodeSatker) {
        
            $bidang = DB::connection('dbbisma')
                ->table('d_costsheet')
                ->selectRaw('
                    d_costsheet.id_cs AS no,
                    d_costsheet.nost AS nost,
                    d_costsheet.tglst AS tglst,
                    d_costsheet.uraianst AS urst,
                    d_costsheet.biaya AS biaya,
                    CONCAT(r_statuscs.kode_status_cs/10," - ",r_statuscs.uraian_perwakilan) AS status
                    ')
                ->leftJoin('r_statuscs', 'd_costsheet.status_cs', '=', 'r_statuscs.id')            
                ->where('d_costsheet.kdindex', '=', $id)
                ->where('d_costsheet.status_cs', 11)
                ->get();

            return json_encode($bidang);

        }
        
    }

    public function viewStatusCsOutstand($id) 
    {
        $keySort = Cookie::get('satker');

        $kodeSatker = Satker::select('key_sort_unit','kode_satker')->where('key_sort_unit', $keySort)->first();

        if ($kodeSatker) {
        
            $bidang = DB::connection('dbbisma')
                ->table('d_costsheet')
                ->selectRaw('
                    d_costsheet.id_cs AS no,
                    d_costsheet.nost AS nost,
                    d_costsheet.tglst AS tglst,
                    d_costsheet.uraianst AS urst,
                    d_costsheet.biaya AS biaya,
                    CONCAT(r_statuscs.kode_status_cs/10," - ",r_statuscs.uraian_perwakilan) AS status
                    ')
                ->leftJoin('r_statuscs', 'd_costsheet.status_cs', '=', 'r_statuscs.id')            
                ->where('d_costsheet.kdindex', '=', $id)
                ->whereIn('d_costsheet.status_cs',[1, 2, 3, 12, 4])
                ->get();

            return json_encode($bidang);

        }
        
    }

    public function viewStatusCsRealisasi($id) 
    {
        $keySort = Cookie::get('satker');

        $kodeSatker = Satker::select('key_sort_unit','kode_satker')->where('key_sort_unit', $keySort)->first();

        if ($kodeSatker) {
        
            $bidang = DB::connection('dbbisma')
                ->table('d_costsheet')
                ->selectRaw('
                    d_costsheet.id_cs AS no,
                    d_costsheet.nost AS nost,
                    d_costsheet.tglst AS tglst,
                    d_costsheet.uraianst AS urst,
                    d_costsheet.biaya AS biaya,
                    CONCAT(r_statuscs.kode_status_cs/10," - ",r_statuscs.uraian_perwakilan) AS status
                    ')
                ->leftJoin('r_statuscs', 'd_costsheet.status_cs', '=', 'r_statuscs.id')            
                ->where('d_costsheet.kdindex', '=', $id)
                ->whereIn('d_costsheet.status_cs',[5, 6, 7, 8, 9])
                ->get();

            return json_encode($bidang);

        }
        
    }

    public function viewStatusLaporan($id) 
    {
        $keySort = Cookie::get('satker');

        $kodeSatker = Satker::select('key_sort_unit','kode_satker')->where('key_sort_unit', $keySort)->first();

        if ($kodeSatker) {
        
            $bidang = CostSheet::with('st')        
                ->where('d_costsheet.id_unit', '=', $id)
                ->groupBy('id_st')
                ->get();

            return json_encode($bidang);

        }
        
    }

    public function viewRekapStatus() 
    {
        $keySort = Cookie::get('satker');

        $kodeSatker = Satker::select('key_sort_unit','kode_satker')->where('key_sort_unit', $keySort)->first();

        if ($kodeSatker) {
        
            $bidang = DB::table('vw_rekap_status')
                ->select(
                    'vw_rekap_status.id_unit as id_unit',
                    'r_unit.nama_unit as nama_unit',
                    'vw_rekap_status.jml_7 as jml_7',
                    'vw_rekap_status.jml_1 as jml_1'
                )
                ->join('r_unit','vw_rekap_status.id_unit','=','r_unit.id_unit')        
                ->where('vw_rekap_status.kode_satker', '=', $kodeSatker->kode_satker)
                ->get();

            return json_encode($bidang);

        }
        
    }

    public function viewStatus1Bidang($id) 
    {
        $keySort = Cookie::get('satker');

        $kodeSatker = Satker::select('key_sort_unit','kode_satker')->where('key_sort_unit', $keySort)->first();

        if ($kodeSatker) {
        
            $bidang = DB::table('t_sima_st')
                ->select(
                    't_sima_st.id_st as id_st',
                    't_sima_st.no_surat_tugas as no_surat_tugas',
                    't_sima_st.tanggal_surat_tugas as tanggal_surat_tugas',
                    't_sima_st.nama_penugasan as nama_penugasan'
                )
                ->leftJoin('t_laporan','t_sima_st.id_st','=','t_laporan.id_st')
                ->where('t_sima_st.jns_tugas','=',2)        
                ->whereNull('t_laporan.id_st')
                ->where('t_sima_st.id_unit',$id)
                ->get();

            return json_encode($bidang);

        }
        
    }

    public function viewStatus7Bidang($id) 
    {
        $keySort = Cookie::get('satker');

        $kodeSatker = Satker::select('key_sort_unit','kode_satker')->where('key_sort_unit', $keySort)->first();

        if ($kodeSatker) {
        
            $bidang = DB::table('t_sima_st')
                ->select(
                    't_sima_st.id_st as id_st',
                    't_sima_st.no_surat_tugas as no_surat_tugas',
                    't_sima_st.tanggal_surat_tugas as tanggal_surat_tugas',
                    't_sima_st.nama_penugasan as nama_penugasan',
                    't_laporan.no_laporan as no_laporan',
                    't_laporan.tgl_laporan as tgl_laporan'
                )
                ->join('t_laporan','t_sima_st.id_st','=','t_laporan.id_st')
                ->where('t_laporan.id_status','=',7)
                ->where('t_sima_st.id_unit',$id)
                ->get();

            return json_encode($bidang);

        }
        
    }

    public function listDlSatker() 
    {  
        $keySort = Cookie::get('satker');

        $kodeSatker = Satker::select('key_sort_unit','kode_satker')->where('key_sort_unit', $keySort)->first();

        if ($kodeSatker) {
            $kdindex = '2023'.$kodeSatker->kode_satker;

            $tugas = DB::connection('dbbisma')
                ->table('t_pegawai_map')
                ->selectRaw(
                    'd_itemcs.id AS iditem,
                    d_costsheet.id_st AS id_st,
                    d_costsheet.nost AS task,
                    d_costsheet.uraianst AS uraianst,
                    d_itemcs.nama AS nama,
                    d_itemcs.tglberangkat AS tglberangkat,
                    d_itemcs.tglkembali AS tglkembali
                    '
                    )
                ->leftJoin('d_itemcs', 't_pegawai_map.nip', '=', 'd_itemcs.nip')
                ->leftJoin('d_costsheet', 'd_itemcs.id_cs', '=', 'd_costsheet.id_cs')
                ->where('tglkembali', '>=', '2023-01-01')
                ->where('t_pegawai_map.key_sort_unit','=', $kodeSatker->key_sort_unit)
                ->orderBy('nama')            
                ->get();

            return json_encode($tugas);
        }        
    }      

}
