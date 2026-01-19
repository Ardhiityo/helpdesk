<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FieldType extends Model
{
    protected $fillable = [
        'name',
        'description'
    ];

    public function submissions()
    {
        return $this->belongsToMany(Submission::class, 'submission_field_type', 'field_type_id', 'submission_id')->withPivot('new_value', 'old_value');
    }
}
