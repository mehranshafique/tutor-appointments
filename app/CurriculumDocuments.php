<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CurriculumDocuments extends Model
{
    use HasFactory;
    public $table = 'curriculum_documents';
    protected $fillable = [
            'file_name',
            'file_size',
            'file_type',
            'child_subject_id',
            'created_at',
            'updated_at',
            'deleted_at',
        ];
}
