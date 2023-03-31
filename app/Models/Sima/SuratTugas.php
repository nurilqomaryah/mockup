<?php

namespace App\Models\Sima;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Bisma\CostSheet;

class SuratTugas extends Model
{
    use HasFactory;

    protected $table = 't_sima_st';
    protected $primaryKey = 'id_st';
    public $timestamps = false;

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'sumber_data',
        'id_st',
        'status_st',
        'status_workflow',
        'no_surat_tugas',
        'tanggal_surat_tugas',
        'nama_penugasan',
        'tanggal_mulai',
        'tanggal_selesai',
        'sumber_dana_id',
        'pembebanan',
        'ro_kode',
        'kdsatker',
        'kode_pkau_pkpt',
        'uraian_pkau_pkpt'
    ];

    /**
     * Get the CS for the ST.
     */
    public function cs()
    {
        return $this->hasMany(CostSheet::class, 'id_st', 'id_st');
    }
}

