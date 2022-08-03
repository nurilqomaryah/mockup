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
                                WHERE table_schema = 'db_mockup'
                                AND table_name NOT LIKE '%vw%'");
    }
}
