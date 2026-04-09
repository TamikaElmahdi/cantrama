<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Contract extends Model
{
    protected $fillable = [
        'user_id',
        'template_id',
        'filled_data',
        'pdf_path',
        'payment_status',
    ];

    protected function casts(): array
    {
        return [
            'filled_data' => 'array',
        ];
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function template()
    {
        return $this->belongsTo(Template::class);
    }

    public function payment()
    {
        return $this->hasOne(Payment::class);
    }
}
