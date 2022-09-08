<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class HariDL extends Model
{
    use HasFactory;

    protected $table = 'vw_hari_dl';
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

    public function getHariDLB1()
    {
        return HariDL::select(
            'nama','jml_hari'
        )
            ->where('id_unitkerja','=',304)
            ->OrderBy('nama')
            ->get();
    }

    public function getHariDLB2()
    {
        return HariDL::select(
            'nama','jml_hari'
        )
            ->where('id_unitkerja','=',305)
            ->OrderBy('nama')
            ->get();
    }

    public function getHariDLTU()
    {
        return HariDL::select(
            'nama','jml_hari'
        )
            ->where('id_unitkerja','=',303)
            ->OrderBy('nama')
            ->get();
    }
}
