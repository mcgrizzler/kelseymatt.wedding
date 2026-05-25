<?php

namespace App\Models;

use App\Enums\RsvpStatus;
use App\Observers\InviteObserver;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Str;

class Invite extends Model
{
    protected $fillable = [
        'name',
        'email',
        'max_guests',
        'token',
        'rsvp_status',
        'rsvp_submitted_at',
    ];

    protected $casts = [
        'rsvp_status' => RsvpStatus::class,
        'rsvp_submitted_at' => 'datetime',
    ];

    protected static function booted(): void
    {
        static::observe(InviteObserver::class);

        static::creating(function (Invite $invite): void {
            $invite->token = (string) Str::uuid();
        });
    }

    public function guests(): HasMany
    {
        return $this->hasMany(Guest::class);
    }
}
