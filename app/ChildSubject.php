<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class ChildSubject extends Model implements HasMedia
{
    use SoftDeletes, HasFactory;
    use InteractsWithMedia;
    public $table = 'child_subjects';

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'name',
        'subject_id',
        'description',
        'picture',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    public function employees()
    {
        return $this->belongsToMany(Employee::class);
    }

    public function subjects()
    {
        return $this->belongsTo(Service::class, 'subject_id');
    }

    public function appointments()
    {
        return $this->belongsToMany(Appointment::class);
    }
}
