<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CostSheet extends Model
{
    use HasFactory;

    protected $table = 'd_costsheet';
    protected $primaryKey = 'id';
    public $timestamps = false;

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'id',
        'id_cs',
        'id_st',
        'kdindex',
        'kdakun',
        'kdbeban',
        'id_tahapan',
        'id_app',
        'nost',
        'uraianst',
        'tglst',
        'tujuanst',
        'biaya',
        'is_active',
        'status_cs'
    ];
}
