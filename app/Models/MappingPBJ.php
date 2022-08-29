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
        return MappingPBJ::select(
            'trx_mapping_pbj.id',
            't_permintaan_pbj.nomor_ppbj',
            't_permintaan_pbj.nama_pbj',
            'ref_pkau.nama_pkau',
            'ref_index.uraian',

        )
            ->join('t_permintaan_pbj','t_permintaan_pbj.id','=','trx_mapping_pbj.id_permintaan_pbj')
            ->join('trx_anggaran_pkau','trx_anggaran_pkau.id','=','trx_mapping_pbj.id_anggaran_pkau')
            ->join('ref_pkau','ref_pkau.id_pkau','=','trx_anggaran_pkau.id_pkau')
            ->join('ref_index','ref_index.kdindex','=','trx_anggaran_pkau.kdindex')
            ->get();
    }
}

