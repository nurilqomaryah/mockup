<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BagiPagu extends Model
{
    use HasFactory;

    protected $table = 'd_bagipagu';
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
        'kdsatker',
        'kddept',
        'kdunit',
        'kdprogram',
        'kdgiat',
        'kdoutput',
        'kdsoutput',
        'kdkmpnen',
        'kdindex',
        'user_id',
        'unit_id',
        'role_id',
        'ppk_id'
    ];
}
