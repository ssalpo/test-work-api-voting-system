<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Contest extends Model
{
    use HasFactory;

    public const MAX_LEVEL = 2;

    public const VOTING_CONDITION_BY_LEVEL = [
        1 => 2,
        2 => 3
    ];

    protected $fillable = ['name'];

    public function contestLevels(): HasMany
    {
        return $this->hasMany(ContestLevel::class);
    }
}
