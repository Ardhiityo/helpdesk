<?php

namespace App\Filament\Auth;

use App\Models\User;
use App\Models\StudyProgram;
use Filament\Schemas\Schema;
use Spatie\Permission\Models\Role;
use Filament\Forms\Components\Select;
use Illuminate\Database\Eloquent\Model;
use Filament\Forms\Components\TextInput;

class Register extends \Filament\Auth\Pages\Register
{
    public function form(Schema $schema): Schema
    {
        return parent::form($schema)
            ->schema([
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
            ]);
    }

    protected function handleRegistration(array $data): Model
    {
        $user_data = [
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => $data['password'],
        ];

        $student_data = [
            'nim' => $data['nim'],
            'study_program_id' => $data['study_program_id'],
        ];

        $user = User::create($user_data);

        $user->student()->create($student_data);

        Role::firstOrCreate([
            'name' => 'student',
        ]);

        $user->assignRole('student');

        return $user;
    }
}
