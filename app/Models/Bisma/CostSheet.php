<?php

namespace App\Models\Bisma;

use Illuminate\Database\Eloquent\Model;
use App\Models\Sima\SuratTugas;

class CostSheet extends Model
{

    protected $connection = 'dbbisma';
    protected $table = 'd_costsheet';
    protected $primaryKey = 'id_cs';
    public $timestamps = false;

    /**
     * Get the ST that owns the CS.
     */
    public function st()
    {
        return $this->belongsTo(SuratTugas::class, 'id_st', 'id_st');
    }

}

