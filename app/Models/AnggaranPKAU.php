<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class AnggaranPKAU extends Model
{
    use HasFactory;

    protected $table = 'trx_anggaran_pkau';
    protected $primaryKey = 'id';
    public $timestamps = false;

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'id',
        'kdindex',
        'id_pkau',
        'tahun',
        'nilai_pkau'
    ];

    //untuk mengambil data yang ditampilkan di index anggaran pkau
    public function getIndexAnggaran(){
        return AnggaranPKAU::select(
            'ref_index.uraian',
            'd_pagu.rupiah',
            DB::raw('SUM(trx_angagran_pkau.nilai_pkau) as total_mapping'),
        )
            ->leftJoin('ref_pkau','ref_pkau.id_pkau','=','trx_anggaran_pkau.id_pkau')
            ->leftJoin('ref_index','ref_index.kdindex','=','trx_anggaran_pkau.kdindex')
            ->leftJoin('d_pagu','d_pagu.kdindex','=','ref_index.kdindex')
            ->get();
    }

    //untuk mengambil data yang dilempar ke dropdown create mapping ST
    public function getPKAUAnggaran(){
        return AnggaranPKAU::select(
            'ref_pkau.nama_pkau',
            'ref_index.uraian',
        )
            ->leftJoin('ref_pkau','ref_pkau.id_pkau','=','trx_anggaran_pkau.id_pkau')
            ->leftJoin('ref_index','ref_index.kdindex','=','trx_anggaran_pkau.kdindex')
            ->get();
    }
}

