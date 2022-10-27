<?php

namespace App\DTO\Base;

use App\Exceptions\InternalErrorException;
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
        if (($args[0] ?? null) instanceof Request) {
            /** @var Request $request */
            $request = $args[0];
            $props = $request->all();
            $this->filledProps = array_keys($props);
        } elseif (is_array($args[0] ?? null)) {
            $props = $args[0];
            $this->filledProps = array_keys($props);
        } else {
            $props = $args;
            $this->filledProps = array_keys($args);
        }

        parent::__construct(...$props);
    }

    public function onlyFilled(array $expect = []): array
    {
        return array_filter($this->all(), function ($val, $key) use ($expect) {
            return in_array($key, $expect) || in_array($key, $this->filledProps);
        }, ARRAY_FILTER_USE_BOTH);
    }

    /**
     * @throws InternalErrorException
     */
    public function set(string $key, $value): void
    {
        try {
            $this->$key;
        } catch (Exception $e) {
            throw new InternalErrorException('Invalid field name!');
        }

        $this->$key = $value;
        if (!in_array($key, $this->filledProps)) {
            $this->filledProps[] = $key;
        }

    }
}
