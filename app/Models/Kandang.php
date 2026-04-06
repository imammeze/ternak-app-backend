<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;

class Kandang extends Model
{
    use HasUuids;

    protected $guarded = [];
}