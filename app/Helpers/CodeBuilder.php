<?php

namespace App\Helpers;

use App\Models\Submission;

class CodeBuilder
{
    public static function generate()
    {
        do {
            $code = random_int(10000000, 99999999);
        } while (Submission::where('code', $code)->exists());

        return $code;
    }
}
