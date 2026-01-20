<?php

namespace App\Filament\Resources\Submissions\Schemas;

use App\Models\FieldType;
use App\Models\DocumentType;
use App\Models\StudyProgram;
use Filament\Forms\Components\FileUpload;
use Filament\Schemas\Schema;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Repeater;
use Filament\Schemas\Components\Wizard;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Components\Wizard\Step;

class SubmissionForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Wizard::make([
                    Step::make('Submission Details')->schema([
                        TextInput::make('name')
                            ->default(fn($state) => auth()->user()->hasRole('student') ? auth()->user()->name : null)
                            ->required(),
                        TextInput::make('nim')
                            ->default(fn($state) => auth()->user()->hasRole('student') ? auth()->user()?->student?->nim : null)
                            ->required(),
                        TextInput::make('email')
                            ->default(fn($state) => auth()->user()->hasRole('student') ? auth()->user()->email : null)
                            ->label('Email address')
                            ->email()
                            ->required(),
                        Select::make('study_program')
                            // Menggunakan null-safe operator agar tidak error jika relasi kosong
                            ->default(fn() => auth()->user()->hasRole('student') ? auth()->user()->student?->studyProgram?->name : null)
                            ->options(function () {
                                // PENTING: pluck('value', 'key')
                                // Kita jadikan 'name' sebagai key agar cocok dengan default value-nya
                                return StudyProgram::all()->pluck('name', 'name');
                            })
                            ->searchable()
                            ->preload()
                            ->exists(table: 'study_programs', column: 'name')
                            ->required(),
                    ]),
                    Step::make('Type of Data Details')
                        ->schema([
                            Repeater::make('submissionFieldTypes')
                                ->relationship('submissionFieldTypes')
                                ->schema([
                                    Select::make('field_type_id')
                                        ->label('Field Type')
                                        ->options(FieldType::all()->pluck('name', 'id'))
                                        ->required()
                                        ->searchable()
                                        ->preload()
                                        ->disableOptionsWhenSelectedInSiblingRepeaterItems(),
                                    TextInput::make('old_value')
                                        ->required(),
                                    TextInput::make('new_value')
                                        ->required(),
                                ])
                                ->addActionLabel('Add Field Type Data')
                                ->reorderable(false)
                        ]),
                    Step::make('Type of Document Details')
                        ->schema([
                            Repeater::make('submissionDocumentTypes')
                                ->relationship('submissionDocumentTypes')
                                ->schema([
                                    Select::make('document_type_id')
                                        ->label('Document Type')
                                        ->options(DocumentType::all()->pluck('name', 'id'))
                                        ->required()
                                        ->searchable()
                                        ->preload()
                                        ->disableOptionsWhenSelectedInSiblingRepeaterItems(),
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
                                ])
                                ->addActionLabel('Add Document Type Data')
                                ->reorderable(false)
                        ]),
                ])
                    ->columnSpanFull()
                    ->visibleOn('create'),
                Section::make('Submission Details')
                    ->schema([
                        TextInput::make('name')
                            ->default(fn($state) => auth()->user()->hasRole('student') ? auth()->user()->name : null)
                            ->required(),
                        TextInput::make('nim')
                            ->default(fn($state) => auth()->user()->hasRole('student') ? auth()->user()?->student?->nim : null)
                            ->required(),
                        TextInput::make('email')
                            ->default(fn($state) => auth()->user()->hasRole('student') ? auth()->user()->email : null)
                            ->label('Email address')
                            ->email()
                            ->required(),
                        Select::make('study_program')
                            // Menggunakan null-safe operator agar tidak error jika relasi kosong
                            ->default(fn() => auth()->user()->hasRole('student') ? auth()->user()->student?->studyProgram?->name : null)
                            ->options(function () {
                                // PENTING: pluck('value', 'key')
                                // Kita jadikan 'name' sebagai key agar cocok dengan default value-nya
                                return StudyProgram::all()->pluck('name', 'name');
                            })
                            ->searchable()
                            ->preload()
                            ->exists(table: 'study_programs', column: 'name')
                            ->required(),
                    ])
                    ->columnSpanFull()
                    ->visibleOn('edit'),
            ]);
    }
}
