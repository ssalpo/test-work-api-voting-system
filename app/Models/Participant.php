<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Arr;

class Participant extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'age',
        'avatar',
        'contest_level_id'
    ];


    public function scopeFilter($q, array $data): void
    {
        $direction = static fn($v) => $v === 'asc' ? 'asc' : 'desc';

        $q->when(
            Arr::get($data, 'name'),
            fn($q, $v) => $q->orderBy('name', $direction($v))
        );

        $q->when(
            Arr::get($data, 'vote'),
            fn($q, $v) => $q->withCount('votes')->orderBy('votes_count', $direction($v))
        );
    }

    public function votes(): HasMany
    {
        return $this->hasMany(Vote::class);
    }

    public function contestLevel(): BelongsTo
    {
        return $this->belongsTo(ContestLevel::class);
    }
}
