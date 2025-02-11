<?php

namespace App\Modules\Key\Repositories;

use App\Main\Repository;
use App\Models\Key;
use Illuminate\Database\Eloquent\Builder;

class KeysRepository extends Repository
{
    public function find(string $key): ?Key
    {
        /** @var Key|null */
        return $this->query()
            ->where('key', $key)
            ->first();
    }

    private function query(): Builder
    {
        return (new Key())->newQuery();
    }
}
