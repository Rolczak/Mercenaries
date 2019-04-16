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
    public function showTimeToNext()
    {
        $last = Carbon::parse($this->lastenergyupdate);
        $last->addMinutes(10);
        $diff = Carbon::now()->diffForHumans($last);
        $energy = $this->actionpoints;
        if($energy < 100)
            return $diff;
        return '-/-';

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
                return round (100*$this->strength);
                break;

            case 2:
                return round (100*$this->accuracy);
                break;

            case 3:
                return round(100*$this->bargaining+(15/100*($this->bargaining+15)));
                break;

            default:

                echo "Error";
        }

    }
    public function calcItemBonus($stat){
        switch ($stat) {
            case 1:
                $value = (($this->getEquippedWeapon()) ? $this->getEquippedWeapon()->str : 0) + (($this->getEquippedArmour()) ? $this->getEquippedArmour()->str : 0);
                return $value;
            case 2:
                $value = (($this->getEquippedWeapon()) ? $this->getEquippedWeapon()->acc : 0) + (($this->getEquippedArmour()) ? $this->getEquippedArmour()->acc : 0);
                return $value;
            case 3:
                $value = (($this->getEquippedWeapon()) ? $this->getEquippedWeapon()->bar : 0) + (($this->getEquippedArmour()) ? $this->getEquippedArmour()->bar : 0);
                return $value;
        }
    }

    public function calcOverallStat($stat){
        switch ($stat) {
            case 1:
                return $this->calcItemBonus(1)+$this->strength;
                break;
            case 2:
                return $this->calcItemBonus(2)+$this->accuracy;
                break;
            case 3:
                return $this->calcItemBonus(3)+$this->bargaining;
                break;
        }
    }
    public function items(){
        return $this->hasMany(Item::class);
    }

    public function getEquippedWeapon(){
        return Item::where('user_id', $this->id)->where('type','weapon')->where('isEquipped', 1)->first();
    }

    public function getEquippedArmour(){
        return Item::where('user_id', $this->id)->where('type','armour')->where('isEquipped', 1)->first();
    }

    public function getAllItems()
    {
        return Item::where('user_id', $this->id)->where('isEquipped', '0')->get();
    }
}
