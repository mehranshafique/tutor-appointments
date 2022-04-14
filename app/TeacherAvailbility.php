<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class TeacherAvailbility extends Model
{
  use SoftDeletes, HasFactory;

  public $table = 'teacher_availbilities';

  protected $dates = [
      'start_time',
      'created_at',
      'updated_at',
      'deleted_at',
      'finish_time',
  ];

  protected $fillable = [
      'comments',
      'start_time',
      'created_at',
      'updated_at',
      'deleted_at',
      'teacher_id',
      'finish_time',
  ];

  public function teacher_availbility()
  {
      return $this->belongsTo(User::class, 'teacher_id');
  }

  protected function serializeDate(\DateTimeInterface $date)
  {
      return $date->format('Y-m-d H:i:s');
  }

}
