<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class StudyProgram extends Model
{
    protected $fillable = [
        'name',
        'description',
        'faculty_id'
    ];

    public function students()
    {
        return $this->hasMany(Student::class, 'study_program_id', 'id');
    }

    public function faculty()
    {
        return $this->belongsTo(Faculty::class, 'faculty_id', 'id');
    }
}
