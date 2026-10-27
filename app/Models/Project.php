<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Project extends Model
{
    use HasFactory;

    protected $guarded = [];

    /**
     * Relationships
     */
    public function organisation(): BelongsTo
    {
        return $this->belongsTo(Organisation::class, 'organization_id');
    }

    public function tasks(): HasMany
    {
        return $this->hasMany(Task::class);
    }
}
