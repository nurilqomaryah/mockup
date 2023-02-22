<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RefPegawai extends Model
{
    use HasFactory;

    protected $table = 'r_pegawai';
    protected $primaryKey = 'id';
    public $timestamps = false;

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'id',
        'niplama',
        'nip',
        'nama',
        'email',
        'kd_instansiunitorg',
        'nama_instansiunitorg',
        'kd_instansiunitkerjal1',
        'nama_instansiunitkerjal1',
        'kd_jabdetail',
        'nm_jabdetail',
        'gol_ruang',
        'nama_pangkat',
        'status',
        'key_sort_unit',
        'idt_unitkerja',
        'nama_unit',
    ];
}

