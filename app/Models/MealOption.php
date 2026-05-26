<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

class MealOption extends Model
{
    protected $fillable = [
        'name',
        'sort_order',
        'is_active',
    ];

    protected $casts = [
        'is_active' => 'boolean',
    ];

    /** @param Builder<MealOption> $query */
    public function scopeActive(Builder $query): void
    {
        $query->where('is_active', true)->orderBy('sort_order');
    }

    /** @return array<string, string> */
    public static function options(): array
    {
        return static::active()->pluck('name', 'name')->all();
    }
}
