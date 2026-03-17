<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class Agenda extends Model
{
    protected $primaryKey = 'id_agenda';
    protected $fillable = ['user_id', 'nama_agenda', 'tanggal', 'deskripsi'];

    public function user() { return $this->belongsTo(User::class); }
}