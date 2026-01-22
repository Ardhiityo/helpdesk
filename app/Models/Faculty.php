<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Faculty extends Model
{
    protected $fillable = [
        'name',
        'description'
    ];

    public function studyPrograms()
    {
        return $this->hasMany(StudyProgram::class, 'faculty_id', 'id');
    }
}
