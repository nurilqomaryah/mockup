<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\SoftDeletes;

class Users extends Authenticatable
{
    use HasFactory, SoftDeletes;

    protected $table = 't_users';
    protected $primaryKey = 'id';
    public $timestamps = false;
    protected $hidden = [
        'password', 'remember_token',
    ];

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

    protected $fillable = [
        'id',
        'nipbaru',
        'username',
        'password',
        'nama',
        'remember_token',
        'role_id',
        'kd_satker',
        'key_sort_unit',
        'token_sima',
        'created_at',
        'updated_at',
        'deleted_at'
    ];

    public function role()
    {
        return $this->belongsTo('App\Models\Role','id');
    }

    public function kodeSatker()
    {

    }

    public function hasRole($roles)
    {
        $this->have_role = $this->getUserRole();

        if(is_array($roles)){
            foreach($roles as $need_role){
                if($this->cekUserRole($need_role)) {
                    return true;
                }
            }
        } else{
            return $this->cekUserRole($roles);
        }
        return false;
    }

    private function getUserRole()
    {
        return $this->role()->getResults();
    }

    private function cekUserRole($role)
    {
        return (strtolower($role)==strtolower($this->have_role->nama_role)) ? true : false;
    }
}
