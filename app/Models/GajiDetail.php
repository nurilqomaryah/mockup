<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GajiDetail extends Model
{
    use HasFactory;

    protected $table = 't_gaji_detail';
    protected $primaryKey = 'id';
    public $timestamps = false;

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'id',
        'gaji_id',
        'potongan',
        'kdindex',
        'kdakun',
        'nilai',

    ];
}
