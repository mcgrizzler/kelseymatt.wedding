<?php

namespace App\Filament\Exports;

use App\Enums\RsvpStatus;
use App\Models\Guest;
use Filament\Actions\Exports\ExportColumn;
use Filament\Actions\Exports\Exporter;
use Filament\Actions\Exports\Models\Export;
use Illuminate\Support\Number;

class GuestExporter extends Exporter
{
    protected static ?string $model = Guest::class;

    public static function getColumns(): array
    {
        return [
            ExportColumn::make('invite.name')
                ->label('Invite'),

            ExportColumn::make('invite.rsvp_status')
                ->label('RSVP Status')
                ->formatStateUsing(fn (mixed $state): string => $state instanceof RsvpStatus
                    ? $state->label()
                    : (RsvpStatus::tryFrom((string) $state)?->label() ?? '')),

            ExportColumn::make('name')
                ->label('Guest Name'),

            ExportColumn::make('is_primary')
                ->label('Primary')
                ->formatStateUsing(fn (mixed $state): string => $state ? 'Yes' : 'No'),

            ExportColumn::make('meal_choice')
                ->label('Meal Choice'),

            ExportColumn::make('dietary_restrictions')
                ->label('Dietary Restrictions'),
        ];
    }

    public static function getCompletedNotificationBody(Export $export): string
    {
        $body = 'Your guest export has completed and '.Number::format($export->successful_rows).' '.str('row')->plural($export->successful_rows).' exported.';

        if ($failedRowsCount = $export->getFailedRowsCount()) {
            $body .= ' '.Number::format($failedRowsCount).' '.str('row')->plural($failedRowsCount).' failed to export.';
        }

        return $body;
    }
}
