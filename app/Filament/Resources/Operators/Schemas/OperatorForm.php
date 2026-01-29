<?php

namespace App\Filament\Resources\Operators\Schemas;

use Filament\Forms\Components\Select;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class OperatorForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make()
                    ->schema([
                        Select::make('user_id')
                            ->relationship(
                                name: 'user',
                                titleAttribute: 'name',
                                modifyQueryUsing: fn($query) => $query->whereHas(
                                    'roles',
                                    fn($q) => $q->where('name', 'operator')
                                )
                            )
                            ->preload()
                            ->searchable()
                            ->required()
                            ->unique(),
                        Select::make('faculty_id')
                            ->relationship('faculty', 'name')
                            ->preload()
                            ->searchable()
                            ->required()
                            ->unique(),
                    ])->columnSpanFull()
            ]);
    }
}
