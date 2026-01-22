<?php

namespace App\Filament\Resources\Submissions\Tables;

use Filament\Tables\Table;
use Filament\Actions\Action;
use Filament\Actions\EditAction;
use Filament\Actions\ViewAction;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Tables\Columns\TextColumn;

class SubmissionsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('code')
                    ->searchable(),
                TextColumn::make('name')
                    ->searchable(),
                TextColumn::make('nim')
                    ->label('NIM')
                    ->searchable(),
                TextColumn::make('email')
                    ->label('Email address')
                    ->searchable(),
                TextColumn::make('study_program')
                    ->searchable(),
                TextColumn::make('status')
                    ->badge(),
                TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                //
            ])
            ->recordActions([
                ViewAction::make(),
                EditAction::make(),
                Action::make('Print')
                    ->icon('heroicon-o-printer')
                    ->url(fn($record) => route('submissions.print', $record))
                    ->openUrlInNewTab()
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }
}
