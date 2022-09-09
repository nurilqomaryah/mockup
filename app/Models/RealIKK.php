<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RealIKK extends Model
{
    use HasFactory;

    protected $table = 'trx_real_ikk';
    protected $primaryKey = 'id_real_ikk';
    public $timestamps = false;

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'id_real_ikk',
        'id_ikk',
        'tahun',
        'bulan',
        'realisasi',
        'ket_real_ikk',
        'created_at',
        'updated_at',
    ];

    /**
     * Digunakan untuk mendapatkan seluruh data realisasi IKK
     * @return Collection
     */
    public function getRealisasiIKK(): Collection
    {
        return RealIKK::select(
            'id_real_ikk',
            'kd_ikk',
            'nama_ikk',
            'tahun',
            'bulan',
            'realisasi'
        )
            ->join('ref_ikk','ref_ikk.id_ikk','=','trx_real_ikk.id_ikk')
            ->get();
    }
}
