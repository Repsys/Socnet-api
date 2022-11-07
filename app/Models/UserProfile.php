<?php

namespace App\Models;

use App\Casts\AliasValue;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * App\Models\UserProfile
 *
 * @property int $id
 * @property int $user_id
 * @property string|null $status_text
 * @property string|null $birthday
 * @property mixed|null|null $gender
 * @property mixed|null|null $relationship
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property int $country_id
 * @property int $city_id
 * @property-read \App\Models\City|null $city
 * @property-read \App\Models\Country $country
 * @property-read \App\Models\User $user
 * @method static \Illuminate\Database\Eloquent\Builder|UserProfile newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|UserProfile newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|UserProfile query()
 * @method static \Illuminate\Database\Eloquent\Builder|UserProfile whereBirthday($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserProfile whereCityId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserProfile whereCountryId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserProfile whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserProfile whereGender($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserProfile whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserProfile whereRelationship($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserProfile whereStatusText($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserProfile whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserProfile whereUserId($value)
 * @mixin \Eloquent
 */
class UserProfile extends Model
{
    use HasFactory;

    const GENDER_MALE = 0;
    const GENDER_FEMALE = 1;

    const GENDERS = [
        self::GENDER_MALE => 'male',
        self::GENDER_FEMALE => 'female'
    ];

    const RELATIONSHIP_SINGLE = 0;
    const RELATIONSHIP_IN_RELATIONSHIP = 1;
    const RELATIONSHIP_MARRIED = 2;
    const RELATIONSHIP_IN_LOVE = 3;
    const RELATIONSHIP_IN_SEARCH = 4;

    const RELATIONSHIPS = [
        self::RELATIONSHIP_SINGLE => 'single',
        self::RELATIONSHIP_IN_RELATIONSHIP => 'in_relationship',
        self::RELATIONSHIP_MARRIED => 'married',
        self::RELATIONSHIP_IN_LOVE => 'in_love',
        self::RELATIONSHIP_IN_SEARCH => 'in_search',
    ];

    protected $fillable = [
        'status_text',
        'birthday',
        'gender',
        'relationship',
        'country',
        'city'
    ];

    protected $hidden = [
        'id',
        'user_id',
        'created_at'
    ];

    protected $casts = [
        'gender' => AliasValue::class,
        'relationship' => AliasValue::class,
    ];

//    protected $appends = [
//        'relationship_raw'
//    ];
//
//    public function getRelationshipRawAttribute(): ?int
//    {
//        return $this->attributes['relationship'];
//    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function country(): BelongsTo
    {
        return $this->belongsTo(Country::class);
    }

    public function city(): BelongsTo
    {
        return $this->belongsTo(City::class);
    }
}
