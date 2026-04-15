<?php

namespace App\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;

class Pengumuman extends Model
{
    use HasUuids;

    protected $table = 'pengumuman'; 
    protected $fillable = ['judul', 'isi', 'user_id'];
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}