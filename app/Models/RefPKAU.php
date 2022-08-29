<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RefPKAU extends Model
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
        return RefPKAU::select('id_pkau','nama_pkau')->get();
    }

    public function getAvailablePKAUByKdIndex($kdIndex)
    {
        return RefPKAU::select(
            'id_pkau',
            'nama_pkau'
        )
            ->whereNotIn('id_pkau',AnggaranPKAU::select('id_pkau')->where('kdindex', $kdIndex)->get())
            ->get();
    }
}
