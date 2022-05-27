<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ReviewRating extends Model
{
    use HasFactory;

    protected $fillable = [
        'appointment_id',
        'student_id',
        'teacher_id',
        'comment',
        'rating',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    public function ReviewData()
    {
      return $this->hasMany('App\Models\ReviewRating','appointment_id');
    }

    public function student_user()
    {
      return $this->hasMany('App\Models\User','student_id', 'user_id');
    }
    public function teacher_user()
    {
      return $this->hasMany('App\Models\User','teacher_id', 'user_id');
    }
}
