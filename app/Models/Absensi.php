<?php

namespace App\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;

class Absensi extends Model
{
    use HasUuids;

    protected $guarded = [];

    protected $casts = [
        'waktu_absen' => 'datetime',
        'aktivitas' => 'array', 
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}