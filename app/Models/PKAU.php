<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PKAU extends Model
{
    use HasFactory;

    protected $table = 'ref_pkau';
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
        'created_at',
        'updated_at',
    ];

    public function getPKAU()
    {
        return PKAU::select('id_pkau','nama_pkau')->get();
    }
}
