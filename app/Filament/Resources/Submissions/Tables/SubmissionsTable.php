<?php

namespace App\Filament\Resources\Submissions\Tables;

use Filament\Tables\Table;
use Filament\Actions\Action;
use Filament\Actions\EditAction;
use Filament\Actions\ViewAction;
use Illuminate\Support\Facades\Auth;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Tables\Columns\TextColumn;
use Illuminate\Support\Facades\Storage;

class SubmissionsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('code')
                    ->searchable(),
                TextColumn::make('name')
                    ->visible(Auth::user()->hasRole('student') ? false : true)
                    ->searchable(),
                TextColumn::make('nim')
                    ->visible(Auth::user()->hasRole('student') ? false : true)
                    ->label('NIM')
                    ->searchable(),
                TextColumn::make('faculty')
                    ->visible(Auth::user()->hasRole('student') ? false : true)
                    ->label('Faculty')
                    ->searchable(),
                TextColumn::make('study_program')
                    ->visible(Auth::user()->hasRole('student') ? false : true)
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
                EditAction::make()->visible(function ($record) {
                    return Auth::user()->hasRole('student') ? $record->status != 'approved' : true;
                }),
                Action::make('Print')
                    ->icon('heroicon-o-printer')
                    ->url(fn($record) => route('submissions.print', $record))
                    ->openUrlInNewTab()
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make()
                        ->before(function ($records) {
                            // Delete all files before bulk delete
                            foreach ($records as $record) {
                                $documentTypes = $record->submissionDocumentTypes;
                                foreach ($documentTypes as $pivotRecord) {
                                    if ($pivotRecord->file && Storage::disk('public')->exists($pivotRecord->file)) {
                                        Storage::disk('public')->delete($pivotRecord->file);
                                    }
                                }
                            }
                        }),
                ]),
            ]);
    }
}
