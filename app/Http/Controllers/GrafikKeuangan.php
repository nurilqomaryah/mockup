<?php

namespace App\Http\Controllers;

use App\Models\RealisasiSisa;
use Illuminate\Database\Eloquent\Model;

class GrafikKeuangan extends Controller
{
    protected $keuangan;

    public function __construct()
    {
        $this->keuangan = new RealisasiSisa();
    }

    public function viewGrafikKeuanganB1()
    {
        $data['listUraian'] = $this->keuangan->getKeuanganB1();
        $data['seriesData'] = $this->getSeriesData($data['listUraian']);
        return view('grafik.grafikkeuangan_b1', $data);
    }

    public function viewGrafikKeuanganB2()
    {
        $data['listUraian'] = $this->keuangan->getKeuanganB2();
        $data['seriesData'] = $this->getSeriesData($data['listUraian']);
        return view('grafik.grafikkeuangan_b2', $data);
    }

    public function viewGrafikKeuanganTU()
    {
        $data['listUraian'] = $this->keuangan->getKeuanganTU();
        $data['seriesData'] = $this->getSeriesData($data['listUraian']);
        return view('grafik.grafikkeuangan_tu', $data);
    }

    public function getSeriesData($listSeries)
    {
        $arrayDataRealisasi = array();
        foreach ($listSeries as $series)
        {
            array_push($arrayDataRealisasi, $series->realisasi);
        }
        $result[] = array(
            'name' => 'Realisasi',
            'data' => $arrayDataRealisasi,
            'index'=> 0,
            'legendIndex' => 0
        );

        $arrayDataOutstanding = array();
        foreach ($listSeries as $series)
        {
            array_push($arrayDataOutstanding, $series->outstanding);
        }
        $result[] = array(
            'name' => 'Outstanding',
            'data' => $arrayDataOutstanding,
            'index'=> 1,
            'legendIndex' => 1
        );

        $arrayDataSisa = array();
        foreach ($listSeries as $series)
        {
            array_push($arrayDataSisa, $series->sisa);
        }
        $result[] = array(
            'name' => 'Sisa',
            'data' => $arrayDataSisa,
            'index'=> 2,
            'legendIndex' => 2
        );
        return json_encode($result);
    }
}
