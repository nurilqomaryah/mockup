<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\AllSchema;
use App\Models\BagiPagu;
use App\Models\CostSheet;
use App\Models\Gaji;
use App\Models\GajiDetail;
use App\Models\Pagu;
use App\Models\PermintaanPBJ;
use App\Models\SimaST;
use App\Models\SuratTugas;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\View;

class MockupController extends Controller
{
    protected $allSchema;

    public function __construct()
    {
        $this->allSchema = new AllSchema();
    }

    public function viewSyncData(){
        $schemaTable = $this->allSchema->getAllTables();
        $result = $this->__combineDataBismaAndDataLocal($schemaTable);
        return View::make('syncdata', ['result' => $result]);
    }

    public function syncData()
    {
        $this->bagipagu();
        $this->costsheet();
        $this->pagu();
        $this->surattugas();
        $this->gaji();
        $this->gajidetail();
        $this->permintaanpbj();
        $this->simast();


        return redirect()
            ->route('syncadmin');
    }

    public function viewDashboard(){

        return View::make('dashboard/dash');
    }

    public function bagipagu()
    {
        // Ambil data dari BISMA
        $result = Http::get('https://apip.bpkp.go.id/bewise/mockup/bagipagu')->collect();

        // Menghitung jumlah data dari BISMA
        $count = count($result);

        // Update tabel d_bagipagu dari data BISMA
        foreach ($result as $insert) {
            $res = BagiPagu::firstOrNew(['id' => $insert['id']]);
            $res->thang = $insert['thang'];
            $res->kdsatker = $insert['kdsatker'];
            $res->kddept = $insert['kddept'];
            $res->kdunit = $insert['kdunit'];
            $res->kdprogram = $insert['kdprogram'];
            $res->kdgiat = $insert['kdgiat'];
            $res->kdoutput = $insert['kdoutput'];
            $res->kdsoutput = $insert['kdsoutput'];
            $res->kdkmpnen = $insert['kdkmpnen'];
            $res->kdindex = $insert['kdindex'];
            $res->user_id = $insert['user_id'];
            $res->unit_id = $insert['unit_id'];
            $res->role_id = $insert['role_id'];
            $res->ppk_id = $insert['ppk_id'];
            $res->save();
        }

        return redirect()
            ->route('syncadmin');
    }

    public function costsheet()
    {
        // Ambil data dari BISMA
        $result = Http::get('https://apip.bpkp.go.id/bewise/mockup/costsheet')->collect();

        // Menghitung jumlah data dari BISMA
        $count = count($result);

        // Update tabel d_costsheet dari data BISMA
        foreach ($result as $insert) {
            $res = CostSheet::firstOrNew(['id' => $insert['id']]);
            $res->id_cs = $insert['id_cs'];
            $res->id_st = $insert['id_st'];
            $res->kdindex = $insert['kdindex'];
            $res->kdakun = $insert['kdakun'];
            $res->kdbeban = $insert['kdbeban'];
            $res->id_tahapan = $insert['id_tahapan'];
            $res->id_app = $insert['id_app'];
            $res->nost = $insert['nost'];
            $res->uraianst = $insert['uraianst'];
            $res->tglst = $insert['tglst'];
            $res->tujuanst = $insert['tujuanst'];
            $res->biaya = $insert['biaya'];
            $res->is_active = $insert['is_active'];
            $res->status_cs = $insert['status_cs'];
            $res->save();
        }

        return redirect()
            ->route('syncadmin');
    }

    
    public function pagu()
    {
        // Ambil data dari BISMA
        $result = Http::get('https://apip.bpkp.go.id/bewise/mockup/pagu')->collect();

        // Menghitung jumlah data dari BISMA
        $count = count($result);

        // Update tabel d_pagu dari data BISMA
        foreach ($result as $insert) {
            $res = Pagu::firstOrNew(['kdindex' => $insert['kdindex']]);
            $res->thang = $insert['thang'];
            $res->kdsatker = $insert['kdsatker'];
            $res->kddept = $insert['kddept'];
            $res->kdunit = $insert['kdunit'];
            $res->kdprogram = $insert['kdprogram'];
            $res->kdgiat = $insert['kdgiat'];
            $res->kdoutput = $insert['kdoutput'];
            $res->kdsoutput = $insert['kdsoutput'];
            $res->kdkmpnen = $insert['kdkmpnen'];
            $res->kdskmpnen = $insert['kdskmpnen'];
            $res->kdbeban = $insert['kdbeban'];
            $res->kdib = $insert['kdib'];
            $res->rupiah = $insert['rupiah'];
            $res->register = $insert['register'];
            $res->revisike = $insert['revisike'];
            $res->tgrevisi = $insert['tgrevisi'];
            $res->norevisi = $insert['norevisi'];
            $res->kdblokir = $insert['kdblokir'];
            $res->save();
        }

        return redirect()
            ->route('syncadmin');
    }

    public function surattugas()
    {
        // Ambil data dari BISMA
        $result = Http::get('https://apip.bpkp.go.id/bewise/mockup/surattugas')->collect();

        // Menghitung jumlah data dari BISMA
        $count = count($result);

        // Update tabel d_surattugas dari data BISMA
        foreach ($result as $insert) {
            $res = SuratTugas::firstOrNew(['id' => $insert['id']]);
            $res->id_st = $insert['id_st'];
            $res->kdindex = $insert['kdindex'];
            $res->thang = $insert['thang'];
            $res->kdgiat = $insert['kdgiat'];
            $res->kdoutput = $insert['kdoutput'];
            $res->kdsoutput = $insert['kdsoutput'];
            $res->kdkmpnen = $insert['kdkmpnen'];
            $res->kdskmpnen = $insert['kdskmpnen'];
            $res->no_kuitansi = $insert['no_kuitansi'];
            $res->nost = $insert['nost'];
            $res->tglst = $insert['tglst'];
            $res->uraianst = $insert['uraianst'];
            $res->tglmulaist = $insert['tglmulaist'];
            $res->tglselesaist = $insert['tglselesaist'];
            $res->id_unit = $insert['id_unit'];
            $res->kdsatker = $insert['kdsatker'];
            $res->status_id = $insert['status_id'];
            $res->is_aktif = $insert['is_aktif'];
            $res->save();
        }

        return redirect()
            ->route('syncadmin');
    }

    public function gaji()
    {
        // Ambil data dari BISMA
        $result = Http::get('https://apip.bpkp.go.id/bewise/mockup/gaji')->collect();

        // Menghitung jumlah data dari BISMA
        $count = count($result);

        // Update tabel t_gaji dari data BISMA
        foreach ($result as $insert) {
            $res = Gaji::firstOrNew(['id' => $insert['id']]);
            $res->thang = $insert['thang'];
            $res->uraian = $insert['uraian'];
            $res->no_gaji = $insert['no_gaji'];
            $res->kdsatker = $insert['kdsatker'];
            $res->jnsgaji_id = $insert['jnsgaji_id'];
            $res->bulan = $insert['bulan'];
            $res->tgl_gaji = $insert['tgl_gaji'];
            $res->status = $insert['status'];
            $res->total = $insert['total'];
            $res->potongan = $insert['potongan'];
            $res->save();
        }

        return redirect()
            ->route('syncadmin');
    }

    public function gajidetail()
    {
        // Ambil data dari BISMA
        $result = Http::get('https://apip.bpkp.go.id/bewise/mockup/gaji_detail')->collect();

        // Menghitung jumlah data dari BISMA
        $count = count($result);

        // Update tabel t_gaji_detail dari data BISMA
        foreach ($result as $insert) {
            $res = GajiDetail::firstOrNew(['id' => $insert['id']]);
            $res->gaji_id = $insert['gaji_id'];
            $res->potongan = $insert['potongan'];
            $res->kdindex = $insert['kdindex'];
            $res->kdakun = $insert['kdakun'];
            $res->nilai = $insert['nilai'];
            $res->save();
        }

        return redirect()
            ->route('syncadmin');
    }

    public function permintaanpbj()
    {
        // Ambil data dari BISMA
        $result = Http::get('https://apip.bpkp.go.id/bewise/mockup/permintaan_pbj')->collect();

        // Menghitung jumlah data dari BISMA
        $count = count($result);

        // Update tabel t_permintaan_pbj dari data BISMA
        foreach ($result as $insert) {
            $res = PermintaanPBJ::firstOrNew(['id' => $insert['id']]);
            $res->tahun_anggaran = $insert['tahun_anggaran'];
            $res->nomor_ppbj = $insert['nomor_ppbj'];
            $res->no_urut = $insert['no_urut'];
            $res->nama_pbj = $insert['nama_pbj'];
            $res->nomor_dok_sumber = $insert['nomor_dok_sumber'];
            $res->tanggal_dok_sumber = $insert['tanggal_dok_sumber'];
            $res->kdindex = $insert['kdindex'];
            $res->kd_satker = $insert['kd_satker'];
            $res->kd_program = $insert['kd_program'];
            $res->kd_giat = $insert['kd_giat'];
            $res->kd_output = $insert['kd_output'];
            $res->kd_kmpnen = $insert['kd_kmpnen'];
            $res->kd_skmpnen = $insert['kd_skmpnen'];
            $res->kd_akun = $insert['kd_akun'];
            $res->kd_ib = $insert['kd_ib'];
            $res->sumberDana_id = $insert['sumberDana_id'];
            $res->jumlah_uang = $insert['jumlah_uang'];
            $res->unit_id = $insert['unit_id'];
            $res->status = $insert['status'];
            $res->save();
        }

        return redirect()
            ->route('syncadmin');
    }

    public function simast()
    {
        // Ambil data dari BISMA
        $result = Http::get('https://apip.bpkp.go.id/bewise/mockup/sima_st')->collect();

        // Menghitung jumlah data dari BISMA
        $count = count($result);

        // Update tabel t_sima_st dari data BISMA
        foreach ($result as $insert) {
            $res = SimaST::firstOrNew(['id_st' => $insert['id_st']]);
            $res->sumber_data = $insert['sumber_data'];
            $res->status_st = $insert['status_st'];
            $res->status_workflow = $insert['status_workflow'];
            $res->no_surat_tugas = $insert['no_surat_tugas'];
            $res->tanggal_surat_tugas = $insert['tanggal_surat_tugas'];
            $res->nama_penugasan = $insert['nama_penugasan'];
            $res->tanggal_mulai = $insert['tanggal_mulai'];
            $res->tanggal_selesai = $insert['tanggal_selesai'];
            $res->id_unit_kerja = $insert['id_unit_kerja'];
            $res->nama_unit_kerja = $insert['nama_unit_kerja'];
            $res->unit_ro_id = $insert['unit_ro_id'];
            $res->ro_kode = $insert['ro_kode'];
            $res->ro_uraian = $insert['ro_uraian'];
            $res->kdsatker = $insert['kdsatker'];
            $res->is_aktif = $insert['is_aktif'];
            $res->save();
        }

        return redirect()
            ->route('syncadmin');
    }

    private function __combineDataBismaAndDataLocal(array $queryAllSchema)
    {
        $result = array();
        foreach ($queryAllSchema as $item)
        {
            $data = (object)array(
                'TABLE_NAME' => $item->table_name,
                'DATA_BISMA' => count_data_bisma(substr($item->table_name,2)),
                'DATA_LOCAL' => count_data_database($item->table_name)
            );

            array_push($result, $data);
        }
        return $result;
    }

}
