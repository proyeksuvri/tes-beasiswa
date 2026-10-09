<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AcademicPeriod extends Model
{
    protected $fillable = [
        'code', 'name', 'semester', 'academic_year_start', 'academic_year_end', 'is_active',
    ];

    protected function casts(): array
    {
        return [
            'academic_year_start' => 'integer',
            'academic_year_end' => 'integer',
            'is_active' => 'boolean',
        ];
    }
}
