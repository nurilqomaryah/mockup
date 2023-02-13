<?php

namespace App\Http\Controllers\Mockup;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\DB;
use App\Models\Sima\SuratTugas;
use App\Models\Sima\SuratTugasTim;
use App\Models\Satker;

class PegawaiController extends Controller
{
    public function viewDashboard()
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
