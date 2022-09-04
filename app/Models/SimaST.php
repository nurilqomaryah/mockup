<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SimaST extends Model
{
    use HasFactory;

    protected $table = 't_sima_st';
    protected $primaryKey = 'id_st';
    public $timestamps = false;

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'id_st',
        'sumber_data',
        'status_st',
        'status_workflow',
        'no_surat_tugas',
        'tanggal_surat_tugas',
        'nama_penugasan',
        'tanggal_mulai',
        'tanggal_selesai',
        'id_unit_kerja',
        'nama_unit_kerja',
        'unit_ro_id',
        'ro_kode',
        'ro_uraian',
        'kdsatker',
        'is_aktif'

    ];

    public function getAvailableST()
    {
        return SimaST::select('id_st','no_surat_tugas','nama_penugasan')
            ->whereNotIn('id_st',MappingST::select('id_st')->get())
            ->get();
    }

    public function getAvailableSTAndCurrentST($currentIdSt)
    {
        return SimaST::select('id_st','no_surat_tugas','nama_penugasan')
            ->whereNotIn('id_st',MappingST::select('id_st')->get())
            ->orWhere('id_st',$currentIdSt)
            ->get();
    }
}

