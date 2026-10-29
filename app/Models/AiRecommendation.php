<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AiRecommendation extends Model
{
    protected $fillable = [
        'user_id',
        'type',
        'period_start',
        'period_end',
        'input_summary',
        'result',
    ];

    protected function casts(): array
    {
        return [
            'period_start' => 'date',
            'period_end' => 'date',
        ];
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}