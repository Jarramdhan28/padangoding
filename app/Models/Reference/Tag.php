<?php

namespace App\Models\Reference;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    use HasUuids;
    protected $fillable = ['name'];
}
