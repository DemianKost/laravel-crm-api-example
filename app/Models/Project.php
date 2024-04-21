<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Project extends Model
{
    use HasFactory;

    /**
     * @return HasMany
     */
    public function interactions(): HasMany
    {
        return $this->hasMany(
            related: Interaction::class,
            foreignKey: 'project_id',
        );
    }
}
