<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

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
        return RefPKAU::select(
            'nama_pkau',
            DB::raw('count(trx_mapping_st.id) as jumlah_st'),
            DB::raw('(select sum(nilai_pkau) FROM trx_anggaran_pkau where trx_anggaran_pkau.id_pkau = ref_pkau.id_pkau) as anggaran')
        )
            ->leftJoin('trx_anggaran_pkau','ref_pkau.id_pkau','=','trx_anggaran_pkau.id_pkau')
            ->leftJoin('trx_mapping_st','trx_mapping_st.id_anggaran_pkau','=','trx_anggaran_pkau.id')
            ->groupBy('nama_pkau')
            ->get();
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
