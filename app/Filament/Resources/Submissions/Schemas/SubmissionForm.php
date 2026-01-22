<?php

namespace App\Filament\Resources\Submissions\Schemas;

use App\Models\FieldType;
use App\Models\DocumentType;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Repeater;
use Filament\Schemas\Components\Wizard;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Components\Section;
use Filament\Forms\Components\FileUpload;
use Filament\Schemas\Components\Wizard\Step;

class SubmissionForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Wizard::make([
                    Step::make('User Details')
                        ->description('Fill in your profile data registered in the academic information system')
                        ->icon(Heroicon::UserCircle)
                        ->schema([
                            TextInput::make('name')
                                ->default(fn($state) => auth()->user()->hasRole('student') ? auth()->user()->name : null)
                                ->required(),
                            TextInput::make('nim')
                                ->label('NIM')
                                ->default(fn($state) => auth()->user()->hasRole('student') ? auth()->user()?->student?->nim : null)
                                ->required(),
                            TextInput::make('email')
                                ->default(fn($state) => auth()->user()->hasRole('student') ? auth()->user()->email : null)
                                ->label('Email address')
                                ->email()
                                ->required()
                        ]),
                    Step::make('Type of Field Details')
                        ->description('Select the data field you want to change')
                        ->icon(Heroicon::ClipboardDocumentList)
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
                        ->description('Upload files according to the instructions in the FAQs menu')
                        ->icon(Heroicon::ClipboardDocumentCheck)
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
                        Select::make('status')
                            ->options([
                                'process' => 'Process',
                                'approved' => 'Approved',
                                'rejected' => 'Rejected',
                            ])
                            ->label('Email address')
                            ->required()
                    ])
                    ->columnSpanFull()
                    ->visibleOn('edit'),
            ]);
    }
}
