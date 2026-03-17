<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pendaftaran extends Model
{
    protected $table = 'pendaftarans';
    protected $primaryKey = 'id_pendaftaran';
    protected $guarded = [];

    // Relasi ke User (Wali Santri)
    public function wali()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

}
