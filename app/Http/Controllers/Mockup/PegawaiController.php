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

class PegawaiController extends Controller
{
    public function viewDashboard()
    {
        $kodeSatker = Satker::select('key_sort_unit','kode_satker')->where('key_sort_unit', Auth::user()->key_sort_unit)->first();
        $now = Carbon::now();

        if($kodeSatker) {
            $user = Http::timeout(0)->withToken(Auth::user()->token_sima)->get('http://api-stara.bpkp.go.id/api/surat-tugas/all?sumber_data=pkau&kode_satker='.$kodeSatker->kode_satker);

            $dataSt = $user['data'];

            foreach ($dataSt as $insert) {

                $dataDetail = $insert['personil'];

                foreach ($dataDetail as $insdtl) {
                    $res2 = SuratTugasTim::firstOrNew(['id_tim' => $insdtl['id_tim']]);
                    $res2->id_st = $insdtl['id_st'];
                    $res2->nip = $insdtl['nip'];
                    $res2->nama = $insdtl['nama'];
                    $res2->golongan = $insdtl['golongan'];
                    $res2->peran = $insdtl['peran'];
                    $res2->jabatan = $insdtl['jabatan'];
                    $res2->urut = $insdtl['urut'];
                    $res2->reff_bisma_unit_id = $insdtl['reff_bisma_unit_id'];
                    $res2->kode_unit = $insdtl['kode_unit'];
                    $res2->save();
                }
            }

            $listBidang = DB::connection('dbbisma')
                ->table('t_unitkerja')
                ->select('id','nama_unit')
                ->whereRaw('LENGTH(map_unitkerja) = 17')
                ->where('satker_id', $kodeSatker->kode_satker)
                ->get();

            $now = Carbon::now();

            return View::make('pegawai.dashpeg')
                ->with(compact('listBidang','now'));
        }
    }

    public function syncPegawai()
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

        RefPegawai::where('key_sort_unit',$kodeSatker->key_sort_unit)->delete();

        $refPegawai = DB::connection('dbbisma')
            ->table('t_pegawai_map')
            ->select(
                't_pegawai_map.id as id',
                't_pegawai_map.niplama as niplama',
                't_pegawai_map.nip as nip',
                't_pegawai_map.nama as nama',
                't_pegawai_map.email as email',
                't_pegawai_map.kd_instansiunitorg as kd_instansiunitorg',
                't_pegawai_map.nama_instansiunitorg as nama_instansiunitorg',
                't_pegawai_map.kd_instansiunitkerjal1 as kd_instansiunitkerjal1',
                't_pegawai_map.nama_instansiunitkerjal1 as nama_instansiunitkerjal1',
                't_pegawai_map.kd_jabdetail as kd_jabdetail',
                't_pegawai_map.nm_jabdetail as nm_jabdetail',
                't_pegawai_map.gol_ruang as gol_ruang',
                't_pegawai_map.nama_pangkat as nama_pangkat',
                't_pegawai_map.status as status',
                't_pegawai_map.key_sort_unit as key_sort_unit',
                't_unitkerja_konversi.id_unitkerja as idt_unitkerja',
                't_unitkerja_konversi.nama_unit_bisma as nama_unit'
            )
            ->leftJoin('t_unitkerja_konversi', 't_pegawai_map.kd_instansiunitkerjal1', '=', 't_unitkerja_konversi.map_unitkerja')
            ->where('t_pegawai_map.key_sort_unit', $kodeSatker->key_sort_unit)
            ->get();

        foreach ($refPegawai as $insert) {
            $ref = RefPegawai::firstOrNew(['id' => $insert->id]);
            $ref->niplama = $insert->niplama;
            $ref->nip = $insert->nip;
            $ref->nama = $insert->nama;
            $ref->email = $insert->email;
            $ref->kd_instansiunitorg = $insert->kd_instansiunitorg;
            $ref->nama_instansiunitorg = $insert->nama_instansiunitorg;
            $ref->kd_instansiunitkerjal1 = $insert->kd_instansiunitkerjal1;
            $ref->nama_instansiunitkerjal1 = $insert->nama_instansiunitkerjal1;
            $ref->kd_jabdetail = $insert->kd_jabdetail;
            $ref->nm_jabdetail = $insert->nm_jabdetail;
            $ref->gol_ruang = $insert->gol_ruang;
            $ref->nama_pangkat = $insert->nama_pangkat;
            $ref->status = $insert->status;
            $ref->key_sort_unit = $insert->key_sort_unit;
            $ref->idt_unitkerja = $insert->idt_unitkerja;
            $ref->nama_unit = $insert->nama_unit;
            $ref->save();
        }

        $listPegawai = DB::table('r_pegawai')
            ->select(
            'id',
            'nama',
            'nip',
            'nama_unit'
            )
            ->where('key_sort_unit', $kodeSatker->key_sort_unit)
            ->get();

        $now = Carbon::now();

        return View::make('pegawai.syncpeg')
            ->with(compact('listBidang','listPegawai','now'));
        }
    }    

    public function viewDashboard2()
    {
        $kodeSatker = Satker::select('key_sort_unit','kode_satker')->where('key_sort_unit', Auth::user()->key_sort_unit)->first();

        if($kodeSatker) {
            $user = Http::withToken(Auth::user()->token_sima)->get('http://api-stara.bpkp.go.id/api/surat-tugas/all?sumber_data=pkau&kode_satker='.$kodeSatker->kode_satker);

            $dataSt = $user['data'];

            foreach ($dataSt as $insert) {

                $dataDetail = $insert['personil'];

                foreach ($dataDetail as $insdtl) {
                    $res2 = SuratTugasTim::firstOrNew(['id_tim' => $insdtl['id_tim']]);
                    $res2->id_st = $insdtl['id_st'];
                    $res2->nip = $insdtl['nip'];
                    $res2->nama = $insdtl['nama'];
                    $res2->golongan = $insdtl['golongan'];
                    $res2->peran = $insdtl['peran'];
                    $res2->jabatan = $insdtl['jabatan'];
                    $res2->urut = $insdtl['urut'];
                    $res2->reff_bisma_unit_id = $insdtl['reff_bisma_unit_id'];
                    $res2->kode_unit = $insdtl['kode_unit'];
                    $res2->save();
                }
            }
        }

        $listPkau = SuratTugas::select('kode_pkau_pkpt','uraian_pkau_pkpt',DB::raw('count(id_st) as total_st'))
            ->groupBy('kode_pkau_pkpt')
            ->orderBy('kode_pkau_pkpt')
            ->get();

        return View::make('pegawai.dashpeg')
            ->with(compact('listPkau'));
    }

}
