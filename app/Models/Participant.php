<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Participant extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'age',
        'avatar',
        'contest_level_id'
    ];

    public function contestLevel(): BelongsTo
    {
        return $this->belongsTo(ContestLevel::class);
    }
}
