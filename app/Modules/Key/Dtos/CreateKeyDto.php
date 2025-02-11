<?php

namespace App\Modules\Key\Dtos;

use App\Main\Dto;

readonly class CreateKeyDto extends Dto
{
    public function __construct(
        public string $name,
        public string $email,
    )
    {
        //
    }
}
