<?php

use Spatie\LaravelPdf\Facades\Pdf;
use Illuminate\Support\Facades\Route;
use Spatie\LaravelPdf\Enums\Format;

Route::get('pdf', function () {
    Pdf::view('tes')
        ->format(Format::A4)
        ->margins(top: 10, right: 20, left: 20, bottom: 20)
        ->save(storage_path('app/public/reports/invoice.pdf'));
    // return view('tes');
});

Route::get('view-pdf', function () {
    return view('tes');
});
