<?php

namespace App\Filament\Imports;

use App\Models\Invite;
use Filament\Actions\Imports\ImportColumn;
use Filament\Actions\Imports\Importer;
use Filament\Actions\Imports\Models\Import;
use Illuminate\Support\Number;

class InviteImporter extends Importer
{
    protected static ?string $model = Invite::class;

    public static function getColumns(): array
    {
        return [
            ImportColumn::make('name')
                ->requiredMapping()
                ->rules(['required', 'string', 'max:255']),

            ImportColumn::make('email')
                ->requiredMapping()
                ->rules(['required', 'email', 'max:255']),

            ImportColumn::make('max_guests')
                ->label('Max Guests')
                ->castStateUsing(fn (?string $state): int => (int) ($state ?? 1))
                ->rules(['nullable', 'integer', 'min:1', 'max:10']),
        ];
    }

    public function resolveRecord(): Invite
    {
        return Invite::firstOrNew(['email' => $this->data['email']]);
    }

    public static function getCompletedNotificationBody(Import $import): string
    {
        $body = 'Your invite import has completed and '.Number::format($import->successful_rows).' '.str('row')->plural($import->successful_rows).' imported.';

        if ($failedRowsCount = $import->getFailedRowsCount()) {
            $body .= ' '.Number::format($failedRowsCount).' '.str('row')->plural($failedRowsCount).' failed to import.';
        }

        return $body;
    }
}
