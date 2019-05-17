<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Ban extends Model
{
    protected $fillable = ['user_id', 'giver_id','reason', 'expired','removed'];

    protected $table = 'bans';
}
