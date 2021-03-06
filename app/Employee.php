<?php

namespace App;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use App\Notifications\EmployeeResetPasswordNotification;
class Employee extends Authenticatable
{
    use Notifiable;
    protected $table = 'employees';
    protected $guard='employee';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'username', 'email', 'password','personalinformation_id','is_leader'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function pi(){
      return $this->belongsTo('App\PI','personalinformation_id','id');
    }
    public function sendPasswordResetNotification($token)
    {
        $this->notify(new EmployeeResetPasswordNotification($token));
    }

    public function isFacultyLeader(){
        if($this->is_leader == 1 ){
            return true;
        }
        else {
            return false;
        }
    }
}
