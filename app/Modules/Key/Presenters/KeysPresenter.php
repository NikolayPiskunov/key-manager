<?php

namespace App\Modules\Key\Presenters;

use App\Models\Key;

class KeysPresenter
{

    public function prepare(Key $key): array
    {
        return [
            'key' => $key->key,
            'expire_at' => $key->expire_at->format('Y-m-d'),
        ];
    }
}
