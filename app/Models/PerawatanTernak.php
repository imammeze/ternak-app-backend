<?php

namespace App\Models;

use App\Models\Ternak;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;

class PerawatanTernak extends Model
{
    use HasUuids;

    protected $guarded = [];

    public function ternak()
    {
        return $this->belongsTo(Ternak::class, 'id_ternak', 'id_ternak');
    }
}