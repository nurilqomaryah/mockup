<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Gaji extends Model
{
    use HasFactory;

    protected $table = 't_gaji';
    protected $primaryKey = 'id';
    public $timestamps = false;

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'id',
        'thang',
        'uraian',
        'no_gaji',
        'kdsatker',
        'jnsgaji_id',
        'bulan',
        'tgl_gaji',
        'status',
        'total',
        'potongan',
    ];
}
