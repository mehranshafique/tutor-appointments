<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Zoom extends Model
{
    use HasFactory;
    public $table = 'zoom';
    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'uuid',
        'id',
        'assistant_id',
        'teacher_id',
        'student_id',
        'appointment_id',
        'host_id',
        'host_email',
        'topic',
        'type',
        'status',
        'start_time',
        'duration',
        'timezone',
        'agenda',
        'start_url',
        'join_url',
        'password',
        'h323_password',
        'pstn_password',
        'pre_schedule',
        'updated_at',
        'deleted_at',
    ];

    public function appointment()
    {
        return $this->belongsTo(Appointment::class);
    }
    
    public function client()
    {
        return $this->belongsTo(User::class, 'client_id');
    }

    public function employee()
    {
        return $this->belongsTo(User::class, 'employee_id');
    }
}
