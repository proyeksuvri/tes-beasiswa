<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SkIssuer extends Model
{
    protected $fillable = ['name', 'abbreviation', 'is_active'];

    protected function casts(): array
    {
        return ['is_active' => 'boolean'];
    }
}
