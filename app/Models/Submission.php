<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Submission extends Model
{
    protected $fillable = [
        'name',
        'nim',
        'email',
        'study_program',
        'status',
        'student_id',
    ];

    public function student()
    {
        return $this->belongsTo(Student::class, 'student_id', 'id');
    }

    public function fieldTypes()
    {
        return $this->belongsToMany(FieldType::class, 'submission_field_type', 'submission_id', 'field_type_id')->withPivot('new_value', 'old_value');
    }

    public function documentTypes()
    {
        return $this->belongsToMany(DocumentType::class, 'submission_document_type', 'submission_id', 'document_type_id')->withPivot('file');
    }
}
