<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphTo;

/**
 * @property string $id
 * @property string $name
 * @property string $value
 */
class Parameter extends Model
{
    use HasFactory, HasUuids;

    protected $fillable = [
        'name',
        'value',
    ];

    public function parametrable(): MorphTo
    {
        return $this->morphTo();
    }
}
