<?php

namespace App\Casts;

use App\Exceptions\ApplicationErrorException;
use Illuminate\Contracts\Database\Eloquent\CastsAttributes;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
use ReflectionClass;

/**
 * Преобразовывает исходное значение в соотвествующее значение(псевдоним) из константного массива, расположенного в классе Модели.
 * Массив, должен содержать элементы, в которых ключ соотвествует исходному значению поля, а значение соответствует псевдониму.
 * Массив определяется автоматически по названию поля, преобразованному во множественное число.
 * Так же название массива можно задать самостоятельно первым параметром #(Alias::class.':name').
 */
class AliasValue implements CastsAttributes
{
    private ?string $enumArrayName;

    public function __construct(?string $enumArrayName = null)
    {
        $this->enumArrayName = $enumArrayName;
    }

    /**
     * Cast the given value.
     *
     * @param Model $model
     * @param string $key
     * @param mixed $value
     * @param array $attributes
     * @return mixed
     */
    public function get($model, string $key, $value, array $attributes): mixed
    {
        $aliasArray = $this->getAliasArray($model, $key);
        return $aliasArray[$value] ?? $value;
    }

    /**
     * Prepare the given value for storage.
     *
     * @param Model $model
     * @param string $key
     * @param mixed $value
     * @param array $attributes
     * @return mixed
     */
    public function set($model, string $key, $value, array $attributes): mixed
    {
        if (!is_null($value)) {
            $aliasArray = $this->getAliasArray($model, $key);
            $value = array_search($value, $aliasArray);
            if ($value === false) {
                throw new ApplicationErrorException(ucfirst($key) . ' is invalid');
            }
        }
        return $value;
    }

    private function getAliasArray($model, string $key)
    {
        $enumArrayName = $this->enumArrayName ?: Str::upper(Str::pluralStudly($key));
        $class = new ReflectionClass($model);
        return $class->getConstant($enumArrayName);
    }
}
