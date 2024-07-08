<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Illuminate\Support\Carbon;
use Illuminate\Support\Str;


/**
 * @property string $id
 * @property string $key
 * @property Carbon $expire_at
 * @property Tariff $tariff
 * @property App $app
 */
class Key extends Model
{
    use HasFactory, HasUuids;

    protected $fillable = [
        'key',
        'expire_at',
        'tariff_id',
        'app_id',
    ];

    protected function casts(): array
    {
        return [
            'created_at' => 'datetime',
        ];
    }

    public function tariff(): BelongsTo
    {
        return $this->belongsTo(Tariff::class);
    }

    public function app(): BelongsTo
    {
        return $this->belongsTo(App::class);
    }

    public function parameters(): MorphMany
    {
        return $this->morphMany(Parameter::class, 'parametrable');
    }

    protected static function booting()
    {
        static::creating(function (self $key) {
            $key->key = Str::uuid();
        });
    }
}
