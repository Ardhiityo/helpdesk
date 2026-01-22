<?php

namespace App\Filament\Widgets;

use App\Models\Faq;
use App\Models\Faculty;
use App\Models\Student;
use App\Models\FieldType;
use App\Models\Submission;
use App\Models\DocumentType;
use App\Models\StudyProgram;
use Spatie\Permission\Models\Role;
use Filament\Widgets\StatsOverviewWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;
use Illuminate\Support\Facades\Auth;

class StatsOverview extends StatsOverviewWidget
{
    protected ?string $heading = 'Stats Overview';

    protected ?string $description = 'An overview of some analytics.';

    protected function getStats(): array
    {
        $user = Auth::user()->load('student');

        if ($user->hasRole('super_admin')) {
            return [
                Stat::make('Submissions', Submission::count()),
                Stat::make('Submissions Processed', Submission::where('status', 'process')->count()),
                Stat::make('Submissions Approved', Submission::where('status', 'approved')->count()),
                Stat::make('Submissions Rejected', Submission::where('status', 'rejected')->count()),
                Stat::make('Field Types', FieldType::count()),
                Stat::make('Document Types', DocumentType::count()),
                Stat::make('Study Programs', StudyProgram::count()),
                Stat::make('Faculties', Faculty::count()),
                Stat::make('FAQs', Faq::count()),
                Stat::make('Students', Student::count()),
                Stat::make('Roles', Role::count()),
            ];
        }

        $student_id = $user?->student?->id;

        return [
            Stat::make('Submissions', Submission::where('student_id', $student_id)->count()),
            Stat::make('Submissions Processed', Submission::where('student_id', $student_id)->where('status', 'process')->count()),
            Stat::make('Submissions Approved', Submission::where('student_id', $student_id)->where('status', 'approved')->count()),
            Stat::make('Submissions Rejected', Submission::where('student_id', $student_id)->where('status', 'rejected')->count()),
            Stat::make('FAQs', Faq::count()),
        ];
    }
}
