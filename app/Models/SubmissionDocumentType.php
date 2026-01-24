<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\Pivot;

class SubmissionDocumentType extends Pivot
{
    public function submission()
    {
        return $this->belongsTo(Submission::class, 'submission_id', 'id');
    }

    public function documentType()
    {
        return $this->belongsTo(DocumentType::class, 'document_type_id', 'id');
    }
}
