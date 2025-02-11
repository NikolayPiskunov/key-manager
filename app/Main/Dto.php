<?php

namespace App\Main;

use Illuminate\Support\Str;

abstract readonly class Dto
{
    public static function fromArray(array $parameters): static
    {
        $dtoProperties = get_class_vars(static::class);
        $withCamelParameters = $parameters;

        foreach ($parameters as $key => $value) {
            $snakeKey = Str::camel($key);
            if (!isset($withCamelParameters[$snakeKey])) {
                $withCamelParameters[$snakeKey] = $value;
            }
        }

        $existsProperties = array_intersect_key($withCamelParameters, $dtoProperties);

        return new static(...$existsProperties);
    }
}
