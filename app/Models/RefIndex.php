<?php


namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RefIndex extends Model
{
    use HasFactory;

    protected $table = 'ref_index';
    protected $primaryKey = 'kdindex';
    public $timestamps = false;

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'kdindex',
        'uraian'

    ];
}

