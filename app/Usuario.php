<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Usuario extends Model
{
    protected $table ='usuarios';

    public $fillable = ['id','first_name','last_name'];
}
