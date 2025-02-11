<?php

namespace App\Modules\Key\Repositories;

use App\Main\Repository;
use App\Models\App;
use Illuminate\Support\Collection;

final class AppsRepository extends Repository
{
    public function forName(string $name): ?App
    {
        /** @var App|null */
        return (new App())->newQuery()
            ->where('name', $name)
            ->first();
    }

    public function getPage(int $page, int $perPage): Collection
    {
        return (new App())->newQuery()
            ->forPage($page, $perPage)
            ->get();
    }
}
