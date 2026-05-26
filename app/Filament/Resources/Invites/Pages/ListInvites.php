<?php

namespace App\Filament\Resources\Invites\Pages;

use App\Filament\Exports\GuestExporter;
use App\Filament\Imports\InviteImporter;
use App\Filament\Resources\Invites\InviteResource;
use App\Models\Guest;
use Filament\Actions\CreateAction;
use Filament\Actions\ExportAction;
use Filament\Actions\ImportAction;
use Filament\Resources\Pages\ListRecords;

class ListInvites extends ListRecords
{
    protected static string $resource = InviteResource::class;

    protected function getHeaderActions(): array
    {
        return [
            ImportAction::make()
                ->importer(InviteImporter::class)
                ->label('Import CSV'),
            ExportAction::make()
                ->exporter(GuestExporter::class)
                ->label('Export Guests')
                ->modifyQueryUsing(fn () => Guest::query()->with('invite')),
            CreateAction::make(),
        ];
    }
}
