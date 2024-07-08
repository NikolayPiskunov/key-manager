<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\MorphMany;

/**
 * @property string $id
 * @property string $name
 * @property App $app
 * @property Collection<Key> $keys
 */
class Tariff extends Model
{
    use HasFactory, HasUuids;

    protected $fillable = [
        'name',
    ];

    public function app(): BelongsTo
    {
        return $this->belongsTo(App::class);
    }

    public function keys(): HasMany
    {
        return $this->hasMany(Key::class, 'tariff_id', 'id');
    }

    public function parameters(): MorphMany
    {
        return $this->morphMany(Parameter::class, 'parametrable');
    }

    public function createKey(): Key
    {
        return $this->keys()->create([
            'app_id' => $this->app->id,
            'expire_at' => now()->modify('+1 month'),
        ]);
    }
}
