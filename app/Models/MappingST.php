<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MappingST extends Model
{
    use HasFactory;

    protected $table = 'trx_mapping_st';
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
        'id_st'
    ];

    /**
     * Digunakan untuk mendapatkan seluruh data realisasi IKK
     * @return Collection
     */
    public function getMappingST(): Collection
    {
        return MappingST::select(
            'id',
            'no_surat_tugas',
            'nama_penugasan',
            'nama_pkau',
            'uraian',

        )
            ->join('t_sima_st','t_sima_st.id_st','=','trx_mapping_st.id_st')
            ->join('trx_anggaran_pkau','trx_anggaran_pkau.id','=','trx_mapping_st.id_anggaran_pkau')
            ->get();
    }
}

