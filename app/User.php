<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password','actionpoints', 'lastenergyupdate'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * Relationships for User
     *
     */

    public function role(){
        return $this->belongsTo(Role::class);
    }

    public function logs(){
        return $this->hasMany(Log::class);
    }

    public function stats(){
        return $this->belongsToMany(Stat::class)->withPivot('value');
    }

    public function items(){
        return $this->belongsToMany(Item::class)->withPivot('value');
    }

    public function isAdmin(){
        if($this->role->name == 'admin')
            return true;
        return false;
    }

    public function calcEnergy()
    {

        $last = Carbon::parse($this->lastenergyupdate);
        $diff = $last->diffInMinutes(Carbon::now());
        $energy = $this->actionpoints;
        floor($diff);
        if($diff>=10)
        {
            for($i=$diff/10;$i>0;$i--)
            {

                if($energy < 100)
                    $energy++;

            }
            $this->actionpoints = $energy;
            $this->lastenergyupdate=Carbon::now()->toDateTimeString();
            $this->save();
        }
    }

    public function showStat($stat)
    {
        return $this->stats->find($stat)->pivot->value;
    }

    public function calcMaxHealth()
    {
        $max = 100;
        $i = $this->stats->find(1)->pivot->value;
        for($i;$i>1; $i--)
        {
            $max = $max+$max*0.1;
        }
        if($this->stats->find(4)->pivot->value > $max)
            $this->stats()->updateExistingPivot(4, ['value'=>$max]);
        return $max;
    }


    public function calcTimeForJS()
    {
        $last = Carbon::parse($this->lastenergyupdate);
        $last->addMinutes(10);
        if($this->actionpoints < 100)
            return $last;
        return false;
    }
    public function calcTrainingCost($stat){
        switch($stat){
            case 1:
                return  round ($this->stats->find($stat)->pivot->value*100);
                break;

            case 2:
                return  round ($this->stats->find($stat)->pivot->value*100);
                break;

            case 3:
                $val = $this->stats->find($stat)->pivot->value;
                return  round ($val*100+(15/100*($val+50)));
                break;

            default:

                echo "Error";
        }

    }

    

}
