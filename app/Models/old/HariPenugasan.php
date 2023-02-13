<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class HariPenugasan extends Model
{
    use HasFactory;

    protected $table = 'vw_hari_kerja';
    protected $primaryKey = 'nip';
    public $timestamps = false;

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'nip',
        'nama',
        'id_unitkerja',
        'jml_hari',

    ];

    public function getHariPenugasanB1()
    {
        return HariPenugasan::select(
            'nama','jml_hari'
        )
            ->where('id_unitkerja','=',304)
            ->OrderBy('nama')
            ->get();
    }

    public function getHariPenugasanB2()
    {
        return HariPenugasan::select(
            'nama','jml_hari'
        )
            ->where('id_unitkerja','=',305)
            ->OrderBy('nama')
            ->get();
    }

    public function getHariPenugasanTU()
    {
        return HariPenugasan::select(
            'nama','jml_hari'
        )
            ->where('id_unitkerja','=',303)
            ->OrderBy('nama')
            ->get();
    }
}
