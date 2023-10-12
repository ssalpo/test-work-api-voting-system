<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class ContestLevel extends Model
{
    use HasFactory;

    protected $fillable = [
        'contest_id',
        'start_date',
        'end_date',
    ];

    protected $casts = [
        'start_date' => 'datetime',
        'end_date' => 'datetime',
    ];

    public function contest(): BelongsTo
    {
        return $this->belongsTo(Contest::class);
    }

    public function participants(): HasMany
    {
        return $this->hasMany(Participant::class);
    }

    public function scopeIsStarted($q, Carbon $date): void
    {
        $q->where('start_date', '<=', $date)
            ->where('end_date', '>=', $date);
    }

    public static function checkIsStartedByContest(int $contestId, Carbon $date): bool
    {
        return self::isStarted($date)
            ->where('contest_id', $contestId)
            ->exists();
    }

    public static function getStartedByContestId(int $contestId, Carbon $date): self
    {
        return self::isStarted($date)
            ->where('contest_id', $contestId)
            ->firstOrFail();
    }
}
