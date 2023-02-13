<?php

namespace App\Models\Sima;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SuratTugasTim extends Model
{
    use HasFactory;

    protected $table = 't_sima_tim';
    protected $primaryKey = 'id_tim';
    public $timestamps = false;

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'id_st',
        'id_tim',
        'nip',
        'nama',
        'golongan',
        'peran',
        'jabatan',
        'urut',
        'reff_bisma_unit_id',
        'kode_unit'
    ];
}

