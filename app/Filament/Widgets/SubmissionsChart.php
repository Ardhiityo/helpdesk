<?php

namespace App\Filament\Widgets;

use App\Models\Submission;
use Flowframe\Trend\Trend;
use Flowframe\Trend\TrendValue;
use Filament\Widgets\ChartWidget;

class SubmissionsChart extends ChartWidget
{
    protected ?string $heading = 'Submissions Chart';

    protected int | string | array $columnSpan = 'full';

    protected ?string $maxHeight = '500px';

    protected bool $isCollapsible = true;

    protected ?string $pollingInterval = '86400s';

    protected function getData(): array
    {
        $data = Trend::model(Submission::class)
            ->between(
                start: now()->startOfYear(),
                end: now()->endOfYear(),
            )
            ->perMonth()
            ->count();

        return [
            'datasets' => [
                [
                    'label' => 'Submissions',
                    'data' => $data->map(fn(TrendValue $value) => $value->aggregate),
                ],
            ],
            'labels' => $data->map(fn(TrendValue $value) => $value->date),
        ];
    }

    protected function getType(): string
    {
        return 'line';
    }

    public function getDescription(): ?string
    {
        return 'The number of submissions per month.';
    }
}
