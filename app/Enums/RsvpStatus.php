<?php

namespace App\Enums;

enum RsvpStatus: string
{
    case Pending = 'pending';
    case Confirmed = 'confirmed';
    case Declined = 'declined';

    public function label(): string
    {
        return match ($this) {
            RsvpStatus::Pending => 'Pending',
            RsvpStatus::Confirmed => 'Confirmed',
            RsvpStatus::Declined => 'Declined',
        };
    }

    public function color(): string
    {
        return match ($this) {
            RsvpStatus::Pending => 'gray',
            RsvpStatus::Confirmed => 'success',
            RsvpStatus::Declined => 'danger',
        };
    }
}
