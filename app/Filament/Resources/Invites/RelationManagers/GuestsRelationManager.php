<?php

namespace App\Filament\Resources\Invites\RelationManagers;

use App\Models\MealOption;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteAction;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Schemas\Schema;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class GuestsRelationManager extends RelationManager
{
    protected static string $relationship = 'guests';

    public function form(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('name')
                    ->required()
                    ->maxLength(255),

                Select::make('meal_choice')
                    ->options(MealOption::options())
                    ->nullable(),

                Textarea::make('dietary_restrictions')
                    ->maxLength(1000)
                    ->columnSpanFull(),

                Toggle::make('is_primary')
                    ->label('Primary Guest'),
            ]);
    }

    public function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('name')
            ->columns([
                IconColumn::make('is_primary')
                    ->label('Primary')
                    ->boolean(),

                TextColumn::make('name'),

                TextColumn::make('meal_choice')
                    ->placeholder('None selected'),

                TextColumn::make('dietary_restrictions')
                    ->limit(40)
                    ->placeholder('None'),
            ])
            ->recordActions([
                EditAction::make(),
                DeleteAction::make(),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }
}
