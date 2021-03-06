<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Workload extends Model
{
    protected $table = 'workloads';
    protected $fillable = [
        'personalinformation_id',
        'subject_code',
        'subject_name',
        'number_of_lessons',
        'class_code',
        'number_of_students',
        'total_workload',
        'theoretical_hours',
        'practice_hours',
        'note',
        'unit_id',
        'semester_id',
        'session_id',
    ];

    public function workloadsession()
    {
        return $this->belongsTo('App\WorkloadSession','session_id','id');
    }
    public function semester()
    {
        return $this->belongsTo('App\Semester','semester_id','id');
    }
    public function unit(){
        return $this->belongsTo('App\Unit','unit_id','id');
    }
    public function pi(){
        return $this->belongsTo('App\PI','personalinformation_id','id');
    }
}
