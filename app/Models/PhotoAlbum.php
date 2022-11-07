<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * App\Models\PhotoAlbum
 *
 * @property int $id
 * @property int $user_id
 * @property int $type
 * @property string|null $name
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Photo[] $photos
 * @property-read int|null $photos_count
 * @property-read \App\Models\User $user
 * @method static \Illuminate\Database\Eloquent\Builder|PhotoAlbum newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|PhotoAlbum newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|PhotoAlbum query()
 * @method static \Illuminate\Database\Eloquent\Builder|PhotoAlbum whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PhotoAlbum whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PhotoAlbum whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PhotoAlbum whereType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PhotoAlbum whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PhotoAlbum whereUserId($value)
 * @mixin \Eloquent
 */
class PhotoAlbum extends Model
{
    use HasFactory;

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function photos(): HasMany
    {
        return $this->hasMany(Photo::class);
    }
}
