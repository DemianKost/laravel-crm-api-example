<?php

declare(strict_types=1);

namespace App\Models;

use App\Models\Concerns\HasUuid;
use Domains\Interactions\Enums\InteractionType;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Interaction extends Model
{
    use HasFactory;
    use HasUuid;

    /**
     * @var string[]
     */
    protected $fillable = [
        'uuid',
        'type',
        'content',
        'contact_id',
        'project_id',
    ];

    /**
     * @return string[]
     */
    protected $casts = [
        'type' => InteractionType::class,
    ];

    /**
     * @return BelongsTo
     */
    public function contact(): BelongsTo
    {
        return $this->belongsTo(
            related: Contact::class,
            foreignKey: 'contact_id',
        );
    }

    /**
     * @return BelongsTo
     */
    public function project(): BelongsTo
    {
        return $this->belongsTo(
            related: Project::class,
            foreignKey: 'project_id',
        );
    }
}
