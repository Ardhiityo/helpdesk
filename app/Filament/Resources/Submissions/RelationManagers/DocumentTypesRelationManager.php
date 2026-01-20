<?php

namespace App\Filament\Resources\Submissions\RelationManagers;

use Filament\Tables\Table;
use App\Models\DocumentType;
use Filament\Actions\Action;
use Filament\Schemas\Schema;
use Filament\Actions\EditAction;
use Filament\Actions\AttachAction;
use Filament\Actions\CreateAction;
use Filament\Actions\DetachAction;
use Filament\Actions\BulkActionGroup;
use Filament\Forms\Components\Select;
use Filament\Actions\DetachBulkAction;
use Filament\Tables\Columns\TextColumn;
use Illuminate\Support\Facades\Storage;
use Filament\Schemas\Components\Section;
use Filament\Forms\Components\FileUpload;
use Filament\Infolists\Components\TextEntry;
use Filament\Resources\RelationManagers\RelationManager;

class DocumentTypesRelationManager extends RelationManager
{
    protected static string $relationship = 'documentTypes';

    protected static ?string $title = 'Document Details';

    public function form(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Document Type')
                    ->schema([
                        Select::make('document_type_id')
                            ->label('Type')
                            ->options(DocumentType::all()->pluck('name', 'id'))
                            ->required()
                            ->searchable()
                            ->preload()
                            ->visibleOn('create'),
                        FileUpload::make('file')
                            ->required()
                            ->directory('documents')
                            ->disk('public')
                            ->visibility('public')
                            ->preserveFilenames()
                            ->downloadable()
                            ->openable()
                            ->maxSize(1024)
                            ->acceptedFileTypes(['application/pdf'])
                            ->hint('PDF files only. Maximum size: 1MB')
                    ])->columnSpanFull()
            ]);
    }

    public function infolist(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextEntry::make('name'),
                TextEntry::make('description')
                    ->placeholder('-')
                    ->columnSpanFull(),
                TextEntry::make('created_at')
                    ->dateTime()
                    ->placeholder('-'),
                TextEntry::make('updated_at')
                    ->dateTime()
                    ->placeholder('-'),
            ]);
    }

    public function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('file')
            ->columns([
                TextColumn::make('name')
                    ->label('Type')
                    ->searchable(),
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
            ->headerActions([
                CreateAction::make(),
                AttachAction::make(),
            ])
            ->recordActions([
                Action::make('View')
                    ->label('Preview')
                    ->icon('heroicon-o-eye')
                    ->url(fn($record) => Storage::url($record->pivot->file))
                    ->openUrlInNewTab(),
                EditAction::make(),
                DetachAction::make(),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DetachBulkAction::make(),
                ]),
            ]);
    }
}
