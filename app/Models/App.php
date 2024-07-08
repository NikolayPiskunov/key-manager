<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;


/**
 * @property string $id
 * @property string $name
 * @property Collection<Tariff> $tariffs
 * @property Collection<Key> $keys
 */
class App extends Model
{
    use HasFactory, HasUuids;

    protected $fillable = [
        'name',
    ];

    public function tariffs(): HasMany
    {
        return $this->hasMany(Tariff::class);
    }

    public function keys(): HasMany
    {
        return $this->hasMany(Key::class);
    }
}
