<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PermintaanPBJ extends Model
{
    use HasFactory;

    protected $table = 't_permintaan_pbj';
    protected $primaryKey = 'id';
    public $timestamps = false;

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'id',
        'tahun_anggaran',
        'nomor_ppbj',
        'no_urut',
        'nama_pbj',
        'nomor_dok_sumber',
        'tanggal_dok_sumber',
        'kdindex',
        'kd_satker',
        'kd_program',
        'kd_giat',
        'kd_output',
        'kd_kmpnen',
        'kd_skmpnen',
        'kd_akun',
        'kd_ib',
        'sumberDana_id',
        'jumlah_uang',
        'unit_id',
        'status'

    ];
}
