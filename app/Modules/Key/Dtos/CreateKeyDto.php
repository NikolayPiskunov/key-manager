<?php

namespace App\Modules\Key\Dtos;

use App\Main\Dto;

class CreateKeyDto extends Dto
{
    public string $name = '';
    public string $email;
}
