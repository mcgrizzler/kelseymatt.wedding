<?php

namespace App\Filament\Resources\Invites\Schemas;

use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class InviteForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('name')
                    ->required()
                    ->maxLength(255),

                TextInput::make('email')
                    ->email()
                    ->required()
                    ->maxLength(255),

                TextInput::make('max_guests')
                    ->label('Max Guests Allowed')
                    ->integer()
                    ->minValue(1)
                    ->maxValue(10)
                    ->default(1)
                    ->required(),
            ]);
    }
}
