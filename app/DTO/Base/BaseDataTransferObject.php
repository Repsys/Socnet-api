<?php

namespace App\DTO\Base;

use App\Exceptions\ApplicationErrorException;
use Exception;
use Illuminate\Http\Request;
use Spatie\DataTransferObject\DataTransferObject;

class BaseDataTransferObject extends DataTransferObject
{
    /**
     * Заполненные пользователем в конструкторе поля
     * @var array|int[]|string[]
     */
    private array $filledProps = [];

    public function __construct(...$args)
    {
        if (isset($args[0])) {
            if ($args[0] instanceof Request) {
                $props = $args[0]->all();
            } elseif (is_array($args[0])) {
                $props = $args[0];
            }
        }

        if (!isset($props))
            $props = $args;

        $this->filledProps = array_keys($props);

        parent::__construct(...$props);
    }

    public function onlyFilled(array $expect = []): array
    {
        return array_filter($this->all(), function ($val, $key) use ($expect) {
            return in_array($key, $expect) || in_array($key, $this->filledProps);
        }, ARRAY_FILTER_USE_BOTH);
    }

    /**
     * @throws ApplicationErrorException
     */
    public function set(string $key, $value): void
    {
        try {
            $this->$key;
        } catch (Exception $e) {
            throw new ApplicationErrorException('Invalid field name!');
        }

        $this->$key = $value;
        if (!in_array($key, $this->filledProps)) {
            $this->filledProps[] = $key;
        }

    }
}
