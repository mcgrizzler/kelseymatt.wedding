<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Guest extends Model
{
    protected $fillable = [
        'invite_id',
        'name',
        'meal_choice',
        'dietary_restrictions',
        'is_primary',
    ];

    protected $casts = [
        'is_primary' => 'boolean',
    ];

    public function invite(): BelongsTo
    {
        return $this->belongsTo(Invite::class);
    }
}
