<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SimaTim extends Model
{
    use HasFactory;

    protected $table = 't_sima_tim';
    protected $primaryKey = 'id_tim';
    public $timestamps = false;

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'id_st',
        'sumber_data',
        'id_tim',
        'nama',
        'nip',
        'peran_jabatan',
        'golongan',
        'no_urut',
        'status'

    ];
}
