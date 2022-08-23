<?php

namespace App\Models;

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

}
