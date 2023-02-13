<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class PenyerapanAnggaran extends Model
{
    use HasFactory;

    protected $table = 'vw_realisasi_rka';
    protected $primaryKey = 'kdindex';
    public $timestamps = false;

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'kdindex',
        'thang',
        'kdsatker',
        'kddept',
        'kdunit',
        'kdprogram',
        'kdgiat',
        'kdoutput',
        'kdsoutput',
        'kdkmpnen',
        'kdskmpnen',
        'kdakun',
        'kdbeban',
        'kdib',
        'rupiah',
        'register',
        'revisike',
        'tgrevisi',
        'norevisi',
        'kdblokir',
        'outstand',
        'draft',
        'realisasi',
        'pagu_index'
    ];

    public function getPenyerapanAnggaran()
    {
        return PenyerapanAnggaran::select(
            'vw_realisasi_rka.kdindex',
            DB::raw('SUM(rupiah) as anggaran'),
            DB::raw('SUM(outstand + realisasi) as realisasi'),
            DB::raw('( SUM(outstand + realisasi) / SUM(rupiah)) * 100 as persentase'),
            'nama_unit'
        )
            ->leftJoin('d_bagipagu','d_bagipagu.kdindex','=','vw_realisasi_rka.kdindex')
            ->join('t_unitkerja','t_unitkerja.id','=','d_bagipagu.unit_id')
            ->where('kel_jab','=','E.III')
            ->groupBy('d_bagipagu.unit_id','t_unitkerja.nama_unit')
            ->orderBy('t_unitkerja.nama_unit')
            ->get();
    }
}
