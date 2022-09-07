<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ItemCs extends Model
{
    use HasFactory;

    protected $table = 'd_itemcs';
    protected $primaryKey = 'id';
    public $timestamps = false;

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'id',
        'id_st',
        'id_cs',
        'nourut',
        'nospd',
        'nama',
        'nip',
        'tglberangkat',
        'tglkembali',
        'jmlhari',
        'jumlah',
        'is_aktif'

    ];
}
