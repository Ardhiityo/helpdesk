<?php

namespace App\Filament\Resources\DocumentTypes;

use UnitEnum;
use BackedEnum;
use Filament\Tables\Table;
use App\Models\DocumentType;
use Filament\Schemas\Schema;
use Filament\Resources\Resource;
use Filament\Support\Icons\Heroicon;
use App\Filament\Resources\DocumentTypes\Pages\EditDocumentType;
use App\Filament\Resources\DocumentTypes\Pages\ListDocumentTypes;
use App\Filament\Resources\DocumentTypes\Pages\CreateDocumentType;
use App\Filament\Resources\DocumentTypes\Schemas\DocumentTypeForm;
use App\Filament\Resources\DocumentTypes\Tables\DocumentTypesTable;

class DocumentTypeResource extends Resource
{
    protected static ?string $model = DocumentType::class;

    protected static string | UnitEnum | null $navigationGroup = 'Type Management';

    protected static string|BackedEnum|null $navigationIcon = Heroicon::ClipboardDocumentCheck;

    protected static ?string $recordTitleAttribute = 'name';

    public static function form(Schema $schema): Schema
    {
        return DocumentTypeForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return DocumentTypesTable::configure($table);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => ListDocumentTypes::route('/'),
            'create' => CreateDocumentType::route('/create'),
            'edit' => EditDocumentType::route('/{record}/edit'),
        ];
    }
}
