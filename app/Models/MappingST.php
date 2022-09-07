<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

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
            'trx_mapping_st.id',
            't_sima_st.no_surat_tugas',
            't_sima_st.nama_penugasan',
            'ref_pkau.nama_pkau',
            'ref_index.uraian',

        )
            ->join('t_sima_st','t_sima_st.id_st','=','trx_mapping_st.id_st')
            ->join('trx_anggaran_pkau','trx_anggaran_pkau.id','=','trx_mapping_st.id_anggaran_pkau')
            ->join('ref_pkau','ref_pkau.id_pkau','=','trx_anggaran_pkau.id_pkau')
            ->join('ref_index','ref_index.kdindex','=','trx_anggaran_pkau.kdindex')
            ->get();
    }

}

