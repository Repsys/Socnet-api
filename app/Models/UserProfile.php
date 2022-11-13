<?php

namespace App\Models;

use App\Casts\AliasValue;
use App\DTO\CountryAndCityData;
use App\Exceptions\ValidationErrorException;
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

    const GENDER_MALE = 'male';
    const GENDER_FEMALE = 'female';

    const GENDERS = [
        0 => self::GENDER_MALE,
        1 => self::GENDER_FEMALE,
    ];

    const RELATIONSHIP_SINGLE = 'single';
    const RELATIONSHIP_IN_RELATIONSHIP = 'in_relationship';
    const RELATIONSHIP_MARRIED = 'married';
    const RELATIONSHIP_IN_LOVE = 'in_love';
    const RELATIONSHIP_IN_SEARCH = 'in_search';

    const RELATIONSHIPS = [
        0 => self::RELATIONSHIP_SINGLE,
        1 => self::RELATIONSHIP_IN_RELATIONSHIP,
        2 => self::RELATIONSHIP_MARRIED,
        3 => self::RELATIONSHIP_IN_LOVE,
        4 => self::RELATIONSHIP_IN_SEARCH,
    ];

    protected $fillable = [
        'status_text',
        'birthday',
        'gender',
        'relationship'
    ];

    protected $hidden = [
        'id',
        'user_id',
        'created_at',
        'country_id',
        'city_id'
    ];

    protected $casts = [
        'gender' => AliasValue::class,
        'relationship' => AliasValue::class,
    ];

    protected $with = [
        'country:id,name',
        'city:id,name',
    ];

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

    public function updateCountryAndCity(CountryAndCityData $data)
    {
        if ($data->isFilled('country_id')) {
            $this->country_id = $data->country_id;

            if (is_null($this->country_id) || (!is_null($this->city_id) && $this->city->country_id != $this->country_id))
                $this->city_id = null;
        }

        if ($data->isFilled('city_id')) {
            if (!is_null($data->city_id)) {
                $city = City::findOrFail($data->city_id);

                if (is_null($this->country_id))
                    throw new ValidationErrorException(['city_id' => 'The city cannot be set while the country is empty.']);
                if ($city->country_id != $this->country_id) {
                    throw new ValidationErrorException(['city_id' => 'The city does not belong to the country.']);
                }
            }
            $this->city_id = $data->city_id;
        }

        $this->save();
    }
}
