<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DocumentType extends Model
{
    protected $fillable = [
        'name',
        'description'
    ];

    public function submissions()
    {
        return $this->belongsToMany(Submission::class, 'submission_document_type', 'document_type_id', 'submission_id')->withPivot('file');
    }
}
