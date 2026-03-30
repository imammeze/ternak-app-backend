<?php

namespace App\Models;

use App\Models\PerawatanTernak;
use App\Models\PerpindahanTernak;
use App\Models\User;
use Illuminate\Database\Eloquent\Model;

class Ternak extends Model
{
    protected $primaryKey = 'id_ternak';
    public $incrementing = false;
    protected $keyType = 'string';
    protected $guarded = [];

    public function pemilik()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function perawatan()
    {
        return $this->hasMany(PerawatanTernak::class, 'id_ternak', 'id_ternak');
    }

    public function perpindahan()
    {
        return $this->hasMany(PerpindahanTernak::class, 'id_ternak', 'id_ternak');
    }
}