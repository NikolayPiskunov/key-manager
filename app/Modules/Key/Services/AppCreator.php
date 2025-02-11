<?php

namespace App\Modules\Key\Services;

use App\Main\Service;
use App\Models\App;
use App\Modules\Key\Dtos\CreateAppDto;

final class AppCreator extends Service
{
    public function create(CreateAppDto $createAppDto): App
    {
        /** @var App */
        return (new App())->newQuery()
            ->create([
                'name' => trim($createAppDto->name),
            ]);
    }
}
