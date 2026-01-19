<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DocumentType extends Model
{
    protected $fillable = [
        'name',
        'description'
    ];

    public function students()
    {
        return $this->belongsToMany(Student::class, 'student_document_type', 'document_type_id', 'student_id');
    }
}
