<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class RealisasiSisa extends Model
{
    use HasFactory;

    protected $table = 'vw_realisasi_sisa';
    protected $primaryKey = null;
    public $timestamps = false;

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'id_unitkerja',
        'uraian',
        'realisasi',
        'outstanding',
        'sisa'
    ];

    public function getKeuanganB1()
    {
        return RealisasiSisa::select(
            'uraian',
            'realisasi',
            'outstanding',
            'sisa'
        )
            ->where('id_unitkerja','=',304)
            ->OrderBy('id_unitkerja')
            ->get();
    }

    public function getKeuanganB2()
    {
        return RealisasiSisa::select(
            'uraian',
            'realisasi',
            'outstanding',
            'sisa'
        )
            ->where('id_unitkerja','=',305)
            ->OrderBy('id_unitkerja')
            ->get();
    }

    public function getKeuanganTU()
    {
        return RealisasiSisa::select(
            'uraian',
            'realisasi',
            'outstanding',
            'sisa'
        )
            ->where('id_unitkerja','=',303)
            ->OrderBy('id_unitkerja')
            ->get();
    }
}
