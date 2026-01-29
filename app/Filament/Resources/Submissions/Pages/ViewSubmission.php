<?php

namespace App\Filament\Resources\Submissions\Pages;

use Filament\Actions\Action;
use Filament\Actions\EditAction;
use Filament\Resources\Pages\ViewRecord;
use App\Filament\Resources\Submissions\SubmissionResource;

class ViewSubmission extends ViewRecord
{
    protected static string $resource = SubmissionResource::class;

    protected function getHeaderActions(): array
    {
        return [
            EditAction::make(),
            Action::make('Print')
                ->icon('heroicon-o-printer')
                ->color('success')
                ->url(fn($record) => route('submissions.print', $record))
                ->openUrlInNewTab()
        ];
    }
}
