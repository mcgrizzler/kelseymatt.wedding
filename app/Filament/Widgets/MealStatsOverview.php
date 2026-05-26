<?php

namespace App\Filament\Widgets;

use App\Enums\RsvpStatus;
use App\Models\Guest;
use App\Models\MealOption;
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

        foreach (MealOption::active()->get() as $index => $mealOption) {
            $count = Guest::whereHas(
                'invite',
                fn ($q) => $q->where('rsvp_status', RsvpStatus::Confirmed)
            )->where('meal_choice', $mealOption->name)->count();

            $stats[] = Stat::make($mealOption->name, $count)
                ->description('guests')
                ->color($colors[$index] ?? 'gray');
        }

        return $stats;
    }
}
