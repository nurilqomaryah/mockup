<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class AllSchema extends Model
{
    use HasFactory;

    public function getAllTables() {
        return DB::select("SELECT table_name FROM information_schema.tables
                                WHERE table_schema = 'db_mockup' AND
                                table_name = 'd_bagipagu' OR
                                table_name = 'd_costsheet' OR
                                table_name = 'd_pagu' OR
                                table_name = 'd_surattugas' OR
                                table_name = 't_gaji' OR
                                table_name = 't_gaji_detail' OR
                                table_name = 't_permintaan_pbj' OR
                                table_name = 't_sima_st'
                                ");
    }
}
