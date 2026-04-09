<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Template extends Model
{
    protected $fillable = [
        'name_fr',
        'name_ar',
        'slug',
        'category',
        'description_fr',
        'fields',
        'pdf_blade_path',
        'is_active',
    ];

    protected function casts(): array
    {
        return [
            'fields' => 'array',
            'is_active' => 'boolean',
        ];
    }

    public function contracts()
    {
        return $this->hasMany(Contract::class);
    }
}
