<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Contest extends Model
{
    use HasFactory;

    protected $fillable = ['contest'];

    public function contestLevels(): HasMany
    {
        return $this->hasMany(ContestLevel::class);
    }
}
