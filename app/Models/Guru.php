<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Guru extends Model
{
    protected $primaryKey = 'id_guru';
    protected $guarded = [];
    public function kelas()
    {
        return $this->hasOne(Kelas::class, 'guru_id');
    }

    public function user()
{
    // Guru ini punya 1 akun User
    return $this->hasOne(User::class, 'guru_id', 'id_guru');
}
}
