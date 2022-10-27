<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Reaction
 *
 * @property int $id
 * @property int $reactionable_id
 * @property string $reactionable_type
 * @property int $user_id
 * @property int $type
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read Model|\Eloquent $reactionable
 * @property-read \App\Models\User $user
 * @method static \Illuminate\Database\Eloquent\Builder|Reaction newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Reaction newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Reaction query()
 * @method static \Illuminate\Database\Eloquent\Builder|Reaction whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Reaction whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Reaction whereReactionableId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Reaction whereReactionableType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Reaction whereType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Reaction whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Reaction whereUserId($value)
 * @mixin \Eloquent
 */
class Reaction extends Model
{
    use HasFactory;

    public function reactionable(): \Illuminate\Database\Eloquent\Relations\MorphTo
    {
        return $this->morphTo();
    }

    public function user(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
