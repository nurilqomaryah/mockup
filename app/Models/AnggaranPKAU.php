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

    //untuk mengambil data yang dilempar ke dropdown create mapping ST
    public function getPKAUAnggaran($kdindex = null){
        $query = AnggaranPKAU::select(
            'trx_anggaran_pkau.id',
            'ref_pkau.id_pkau',
            'ref_pkau.nama_pkau',
            'ref_index.uraian',
            'trx_anggaran_pkau.nilai_pkau'
        )
            ->leftJoin('ref_pkau','ref_pkau.id_pkau','=','trx_anggaran_pkau.id_pkau')
            ->leftJoin('ref_index','ref_index.kdindex','=','trx_anggaran_pkau.kdindex');
        if(!is_null($kdindex))
            $query->where('trx_anggaran_pkau.kdindex',$kdindex);

        return $query->get();
    }

    //untuk dipanggil di mapping anggaran
    public function getNilaiPKAUByKdIndex($kdindex)
    {
        return AnggaranPKAU::select('nilai_pkau')
            ->where('kdindex', $kdindex)
            ->sum('nilai_pkau');
    }

    //untuk menampilkan nilai anggaran PKAU di Dashboard
    public function getAnggaranPKAU(){
        return AnggaranPKAU::select('nilai_pkau')
            ->sum('nilai_pkau')
            ->groupBy('id_pkau')
            ->get();
    }

}
