<?php

namespace App\Http\Controllers;

use App\Models\HariDL;
use App\Models\HariPenugasan;
use Illuminate\Database\Eloquent\Model;

class GrafikPegawai extends Controller
{
    protected $haripenugasan;
    protected $haridinas;

    public function __construct()
    {
        $this->haripenugasan = new HariPenugasan();
        $this->haridinas = new HariDL();
    }

    public function viewGrafikPegawaiB1()
    {
        $data1['grafikST'] = $this->haripenugasan->getHariPenugasanB1();
        $data2['grafikDL'] = $this->haridinas->getHariDLB1();
        return view('grafik.grafikpegawai_b1', $data1, $data2);
    }

    public function viewGrafikPegawaiB2()
    {
        $data1['grafikST'] = $this->haripenugasan->getHariPenugasanB2();
        $data2['grafikDL'] = $this->haridinas->getHariDLB2();
        return view('grafik.grafikpegawai_b2', $data1, $data2);
    }

    public function viewGrafikPegawaiTU()
    {
        $data1['grafikST'] = $this->haripenugasan->getHariPenugasanTU();
        $data2['grafikDL'] = $this->haridinas->getHariDLTU();
        return view('grafik.grafikpegawai_tu', $data1, $data2);
    }

}
