<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pagu extends Model
{
    use HasFactory;

    protected $table = 'd_pagu';
    protected $primaryKey = 'kdindex';
    public $timestamps = false;

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'kdindex',
        'thang',
        'kdsatker',
        'kddept',
        'kdunit',
        'kdprogram',
        'kdgiat',
        'kdoutput',
        'kdsoutput',
        'kdkmpnen',
        'kdskmpnen',
        'kdakun',
        'kdbeban',
        'kdib',
        'rupiah',
        'register',
        'revisike',
        'tgrevisi',
        'norevisi',
        'kdblokir'
    ];
}
