<?php

namespace App\Filament\Resources\Invites\Tables;

use App\Enums\RsvpStatus;
use App\Jobs\SendInviteEmail;
use App\Models\Invite;
use Filament\Actions\Action;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteAction;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Notifications\Notification;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;

class InvitesTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('name')
                    ->searchable()
                    ->sortable(),

                TextColumn::make('email')
                    ->searchable()
                    ->copyable(),

                TextColumn::make('max_guests')
                    ->label('Max Guests')
                    ->sortable(),

                TextColumn::make('rsvp_status')
                    ->label('Status')
                    ->badge()
                    ->color(fn (RsvpStatus $state): string => $state->color())
                    ->formatStateUsing(fn (RsvpStatus $state): string => $state->label()),

                TextColumn::make('guests_count')
                    ->label('Guests')
                    ->counts('guests')
                    ->sortable(),

                TextColumn::make('rsvp_submitted_at')
                    ->label('Submitted')
                    ->since()
                    ->sortable()
                    ->placeholder('Not yet'),
            ])
            ->filters([
                SelectFilter::make('rsvp_status')
                    ->label('Status')
                    ->options(collect(RsvpStatus::cases())->mapWithKeys(
                        fn (RsvpStatus $status) => [$status->value => $status->label()]
                    )),
            ])
            ->recordActions([
                Action::make('sendInvite')
                    ->label('Send Invite')
                    ->icon('heroicon-o-envelope')
                    ->color('info')
                    ->requiresConfirmation()
                    ->modalHeading('Send Invite Email')
                    ->modalDescription('This will send the magic-link invite email to this guest.')
                    ->visible(fn (Invite $record): bool => $record->rsvp_status === RsvpStatus::Pending)
                    ->action(function (Invite $record): void {
                        SendInviteEmail::dispatch($record);

                        Notification::make()
                            ->title('Invite queued for '.$record->email)
                            ->success()
                            ->send();
                    }),
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
