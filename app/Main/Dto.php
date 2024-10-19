<?php

namespace App\Main;

abstract class Dto
{
    public static function fromArray(array $parameters): static
    {
        $dto = new static;

        foreach ($parameters as $key => $value) {
            if (property_exists($dto, $key)) {
                $dto->{$key} = $value;
            }
        }


        return $dto;
    }
}
