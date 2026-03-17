<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class Home extends Model
{
    protected $primaryKey = 'id_home';
    protected $fillable = ['user_id', 'sambutan', 'banner'];

    public function user() { return $this->belongsTo(User::class); }
}