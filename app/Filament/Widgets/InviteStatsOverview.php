<?php

namespace App\Filament\Widgets;

use App\Enums\RsvpStatus;
use App\Models\Guest;
use App\Models\Invite;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class InviteStatsOverview extends BaseWidget
{
    protected function getStats(): array
    {
        $total = Invite::count();
        $confirmed = Invite::where('rsvp_status', RsvpStatus::Confirmed)->count();
        $declined = Invite::where('rsvp_status', RsvpStatus::Declined)->count();
        $pending = Invite::where('rsvp_status', RsvpStatus::Pending)->count();
        $responded = $confirmed + $declined;
        $responseRate = $total > 0 ? round($responded / $total * 100) : 0;
        $guestsAttending = Guest::whereHas(
            'invite',
            fn ($q) => $q->where('rsvp_status', RsvpStatus::Confirmed)
        )->count();

        return [
            Stat::make('Total Invites', $total)
                ->description('Invitations sent')
                ->descriptionIcon('heroicon-m-envelope')
                ->color('info'),

            Stat::make('Confirmed', $confirmed)
                ->description('RSVPs accepted')
                ->descriptionIcon('heroicon-m-check-circle')
                ->color('success'),

            Stat::make('Declined', $declined)
                ->description('RSVPs declined')
                ->descriptionIcon('heroicon-m-x-circle')
                ->color('danger'),

            Stat::make('Pending', $pending)
                ->description('Awaiting response')
                ->descriptionIcon('heroicon-m-clock')
                ->color('warning'),

            Stat::make('Guests Attending', $guestsAttending)
                ->description('From confirmed invites')
                ->descriptionIcon('heroicon-m-user-group')
                ->color('success'),

            Stat::make('Response Rate', $responseRate.'%')
                ->description("{$responded} of {$total} responded")
                ->descriptionIcon('heroicon-m-chart-bar')
                ->color($responseRate >= 75 ? 'success' : ($responseRate >= 40 ? 'warning' : 'danger')),
        ];
    }
}
