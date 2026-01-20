<?php

namespace App\Filament\Resources\Students\Schemas;

use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class StudentForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('nim')
                    ->required(),
                Select::make('study_program_id')
                    ->relationship('studyProgram', 'name')
                    ->required(),
                Select::make('user_id')
                    ->relationship(
                        name: 'user',
                        titleAttribute: 'name',
                        modifyQueryUsing: fn($query) => $query->whereHas('roles', fn($query) => $query->where('name', 'student')),
                    )
                    ->required(),
            ]);
    }
}
