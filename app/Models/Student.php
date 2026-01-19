<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    protected $fillable = [
        'nim',
        'user_id',
        'study_program_id',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function studyProgram()
    {
        return $this->belongsTo(StudyProgram::class, 'study_program_id', 'id');
    }

    public function documentTypes()
    {
        return $this->belongsToMany(DocumentType::class, 'student_document_type', 'student_id', 'document_type_id');
    }
}
