<?php

namespace App\Http\Controllers;

use App\Models\HariDL;
use Illuminate\Database\Eloquent\Model;

class GrafikKeuangan extends Controller
{
    protected $haridinas;

    public function __construct()
    {
        $this->haridinas = new HariDL();
    }

    public function viewGrafikHariDL()
    {
        $data['listCategory'] = $this->haridinas->getHariDL();
        return view('grafik.jmlharipenugasan', $data);
    }

}
