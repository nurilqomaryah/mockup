<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RefIKK extends Model
{
    use HasFactory;

    protected $table = 'ref_ikk';
    protected $primaryKey = 'id_ikk';
    public $timestamps = false;

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'id_ikk',
        'id_saskeg',
        'kd_ikk',
        'nama_ikk',
        'target',
        'satuan',
        'created_at',
        'updated_at',
    ];

    public function getTargetAndRealisasi()
    {
        return RefIKK::select('ref_ikk.id_ikk','kd_ikk','nama_ikk','target','satuan','realisasi')
                  ->leftJoin('trx_real_ikk','trx_real_ikk.id_ikk','=','ref_ikk.id_ikk')
                  ->get();
    }
}
