<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SubmissionController;

Route::get('submissions/{submission:code}/print', [SubmissionController::class, 'print'])
    ->name('submissions.print');
