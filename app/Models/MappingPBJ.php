<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MappingPBJ extends Model
{
    use HasFactory;

    protected $table = 'trx_mapping_pbj';
    protected $primaryKey = 'id';
    public $timestamps = false;

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'id',
        'id_anggaran_pkau',
        'id_permintaan_pbj'
    ];

    /**
     * Digunakan untuk mendapatkan seluruh data realisasi IKK
     * @return Collection
     */
    public function getMappingPBJ(): Collection
    {
        return MappingST::select(
            'id',
            'nomor_ppbj',
            'nama_pbj',
            'nama_pkau',
            'uraian',

        )
            ->join('t_permintaan_pbj','t_permintaan_pbj.id','=','trx_mapping_pbj.id_permintaan_pbj')
            ->join('trx_anggaran_pkau','trx_anggaran_pkau.id','=','trx_mapping_pbj.id_anggaran_pkau')
            ->get();
    }
}

