<?php

namespace App\Filament\Resources\Invites\Pages;

use App\Filament\Imports\InviteImporter;
use App\Filament\Resources\Invites\InviteResource;
use Filament\Actions\CreateAction;
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
            CreateAction::make(),
        ];
    }
}
