<?php

namespace App\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;

class ProduksiSusu extends Model
{
    use HasUuids;

    protected $guarded = [];

    public function pemilik()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
}