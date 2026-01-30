<?php

namespace App\Http\Controllers;

use Mpdf\Mpdf;
use App\Models\Submission;
//use Spatie\LaravelPdf\Enums\Format;
//use function Spatie\LaravelPdf\Support\pdf;

class SubmissionController extends Controller
{
    public function print(Submission $submission)
    {
        $submission->load('fieldTypes');
        /**
         * Need : Node js
        return pdf()
            ->view('filament.submissions', ['record' => $submission])
            ->format(Format::A4)
            ->margins(top: 10, right: 20, left: 20, bottom: 20);
         */

        $mpdf = new Mpdf();
        $mpdf->WriteHTML(view('filament.submissions', ['record' => $submission]));
        return $mpdf->Output();
    }
}
