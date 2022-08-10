<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SuratTugas extends Model
{
    use HasFactory;

    protected $table = 'd_surattugas';
    protected $primaryKey = 'id';
    public $timestamps = false;

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'id',
        'id_st',
        'kdindex',
        'thang',
        'kdgiat',
        'kdoutput',
        'kdsoutput',
        'kdkmpnen',
        'kdskmpnen',
        'no_kuitansi',
        'nost',
        'tglst',
        'uraianst',
        'tglmulaist',
        'tglselesaist',
        'id_unit',
        'kdsatker',
        'status_id',
        'is_aktif'
    ];
}
