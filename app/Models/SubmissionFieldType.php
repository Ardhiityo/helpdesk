<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\Pivot;

class SubmissionFieldType extends Pivot
{
    protected $fillable = [
        'submission_id',
        'field_type_id',
        'new_value',
        'old_value'
    ];

    public function submission()
    {
        return $this->belongsTo(Submission::class, 'submission_id', 'id');
    }

    public function fieldType()
    {
        return $this->belongsTo(FieldType::class, 'field_type_id', 'id');
    }
}
