<?php

namespace App\Modules\Key\Dtos;

use App\Main\Dto;

readonly class CreateAppDto extends Dto
{
    public function __construct(
        public string $name,
    )
    {
        //
    }
}
