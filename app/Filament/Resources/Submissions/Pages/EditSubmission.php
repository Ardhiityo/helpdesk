<?php

namespace App\Filament\Resources\Submissions\Pages;

use Filament\Actions\ViewAction;
use Filament\Actions\DeleteAction;
use Illuminate\Support\Facades\Auth;
use Filament\Resources\Pages\EditRecord;
use App\Filament\Resources\Submissions\SubmissionResource;

class EditSubmission extends EditRecord
{
    protected static string $resource = SubmissionResource::class;

    protected function authorizeAccess(): void
    {
        abort_unless(static::getResource()::canEdit($this->getRecord()), 403);

        $user = Auth::user();

        if ($user->hasRole('student')) {
            $this->getRecord()->status === 'approved' ? abort(403) : null;
        }
    }

    protected function getHeaderActions(): array
    {
        return [
            ViewAction::make(),
            DeleteAction::make(),
        ];
    }
}
