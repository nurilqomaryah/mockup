<?php


namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class RefIndex extends Model
{
    use HasFactory;

    protected $table = 'ref_index';
    protected $primaryKey = 'kdindex';
    protected $keyType = 'string';
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

    /**
     * Digunakan untuk mengambil data KD Index dan digunakan untuk melakukan pemetaan anggaran
     * @return mixed
     */
    public function getKdIndexForMapping()
    {
        return RefIndex::select(
            'ref_index.kdindex',
            'ref_index.uraian',
            'd_pagu.rupiah',
            DB::raw('(SELECT SUM(nilai_pkau) FROM trx_anggaran_pkau WHERE trx_anggaran_pkau.kdindex = ref_index.kdindex) as total_mapping')
        )
            ->leftJoin('d_pagu','d_pagu.kdindex','=','ref_index.kdindex')
            ->orderBy('ref_index.kdindex')
            ->get();
    }
}

