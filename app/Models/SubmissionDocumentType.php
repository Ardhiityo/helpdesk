<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\Pivot;

class SubmissionDocumentType extends Pivot
{
    protected $fillable = [
        'submission_id',
        'document_type_id',
        'file'
    ];

    public function submission()
    {
        return $this->belongsTo(Submission::class, 'submission_id', 'id');
    }

    public function documentType()
    {
        return $this->belongsTo(DocumentType::class, 'document_type_id', 'id');
    }
}
