<?php

namespace App\Filament\Widgets;

use App\Enums\RsvpStatus;
use App\Models\Guest;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class MealStatsOverview extends BaseWidget
{
    protected ?string $heading = 'Meal Selections';

    protected ?string $description = 'From confirmed RSVPs only';

    protected function getStats(): array
    {
        $colors = ['success', 'info', 'warning', 'primary'];

        $stats = [];

        foreach (config('wedding.meal_options') as $index => $meal) {
            $count = Guest::whereHas(
                'invite',
                fn ($q) => $q->where('rsvp_status', RsvpStatus::Confirmed)
            )->where('meal_choice', $meal)->count();

            $stats[] = Stat::make($meal, $count)
                ->description('guests')
                ->color($colors[$index] ?? 'gray');
        }

        return $stats;
    }
}
