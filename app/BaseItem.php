<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BaseItem extends Model
{
    protected $fillable = ['name', 'image_path', 'type'];
}
