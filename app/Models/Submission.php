<?php

namespace App\Models;

use App\Models\Student;
use App\Models\FieldType;
use App\Models\DocumentType;
use Illuminate\Support\Facades\Auth;
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

    protected static function booted()
    {
        parent::booted();

        self::creating(function (Submission $submission) {
            if (Auth::user()->hasRole('student')) {
                $submission->student_id = Auth::user()->student->id;
            }
        });
    }

    public function student()
    {
        return $this->belongsTo(Student::class, 'student_id', 'id');
    }

    public function submissionFieldTypes()
    {
        return $this->hasMany(SubmissionFieldType::class);
    }

    public function submissionDocumentTypes()
    {
        return $this->hasMany(SubmissionDocumentType::class);
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
