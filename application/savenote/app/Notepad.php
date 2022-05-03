<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Notepad extends Model
{
    protected $fillable = [
        'url',
        'type',
        'password'
    ];
}
