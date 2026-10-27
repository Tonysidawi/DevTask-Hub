<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Organisation extends Model
{
    use HasFactory;

    protected $table = 'organizations';

    protected $fillable = ['name', 'slug'];

    /**
     * Relationships
     */
    public function projects(): HasMany
    {
        return $this->hasMany(Project::class, 'organization_id');
    }

    public function users(): HasMany
    {
        return $this->hasMany(User::class, 'organization_id');
    }
}
