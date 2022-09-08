<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class RealisasiPKAU extends Model
{
    use HasFactory;

    protected $table = 'vw_realisasi_pkau';
    protected $primaryKey = 'id_pkau';
    public $timestamps = false;

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'id_pkau',
        'nama_pkau',
        'realisasi'
    ];

}

