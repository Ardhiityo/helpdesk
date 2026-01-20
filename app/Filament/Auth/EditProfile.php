<?php

namespace App\Filament\Auth;

use App\Models\StudyProgram;
use Filament\Schemas\Schema;
use Filament\Facades\Filament;
use Illuminate\Support\Facades\Auth;
use Filament\Forms\Components\Select;
use Illuminate\Database\Eloquent\Model;
use Filament\Forms\Components\TextInput;

class EditProfile extends \Filament\Auth\Pages\EditProfile
{
    public function form(Schema $schema): Schema
    {
        $user = Auth::user();

        if ($user->hasRole('student')) {
            return $schema
                ->components([
                    $this->getNameFormComponent(),
                    TextInput::make('nim')
                        ->label('NIM')
                        ->numeric()
                        ->required()
                        ->minLength(7)
                        ->maxLength(20),
                    Select::make('study_program_id')
                        ->label('Study Program')
                        ->options(StudyProgram::pluck('name', 'id'))
                        ->exists('study_programs', 'id')
                        ->required()
                        ->preload()
                        ->searchable(),
                    $this->getEmailFormComponent(),
                    $this->getPasswordFormComponent(),
                    $this->getPasswordConfirmationFormComponent(),
                    $this->getCurrentPasswordFormComponent(),
                ]);
        }

        return $schema
            ->components([
                $this->getNameFormComponent(),
                $this->getEmailFormComponent(),
                $this->getPasswordFormComponent(),
                $this->getPasswordConfirmationFormComponent(),
                $this->getCurrentPasswordFormComponent(),

            ]);
    }

    protected function mutateFormDataBeforeFill(array $data): array
    {
        $user = Auth::user();

        if ($user->hasRole('student')) {
            $user->load('student.studyProgram');
            $data['nim'] = $user->student?->nim;
            $data['study_program_id'] = $user->student?->study_program_id;
        };

        return $data;
    }

    protected function handleRecordUpdate(Model $record, array $data): Model
    {
        if (Filament::hasEmailChangeVerification() && array_key_exists('email', $data)) {
            $this->sendEmailChangeVerification($record, $data['email']);

            unset($data['email']);
        }

        $record->update($data);

        if (Auth::user()->hasRole('student')) {
            $record->student()->update([
                'nim' => $data['nim'],
                'study_program_id' => $data['study_program_id'],
            ]);
        }

        return $record;
    }
}
