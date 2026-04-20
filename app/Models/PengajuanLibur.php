<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;

class PengajuanLibur extends Model
{
    use HasUuids;
    
    protected $fillable = ['user_id', 'tanggal', 'catatan', 'status'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}