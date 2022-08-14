<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Users extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 't_users';
    protected $primaryKey = 'id';

    /**
     * Digunakan untuk mencari user berdasarkan username dan password
     *
     * @param string $username
     * @param string $password
     * @return mixed
     */
    public function findUser($username, $password)
    {
        return Users::select('*')
            ->where('username', $username)
            ->where('password', $password)
            ->get();
    }
}
