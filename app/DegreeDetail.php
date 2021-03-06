<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DegreeDetail extends Model
{
    protected $table = 'degreedetails';

    protected $fillable = [
        'date_of_issue',
        'place_of_issue',
        'personalinformation_id',
        'degree_id',
        'industry_id',
        'specialized',
        'nation_of_issue_id',
        'degree_type',
    ];

    public function pi(){
      return $this->belongsTo('App\PI','personalinformation_id','id');
    }

    public function country(){
        return $this->belongsTo('App\Country','nation_of_issue_id','id');
      }

    public function degree(){
      return $this->belongsTo('App\Degree','degree_id','id');
    }
    public function industry(){
        return $this->belongsTo('App\Industry','industry_id','id');
    }

}
