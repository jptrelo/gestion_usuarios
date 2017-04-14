<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Usuarios extends Model
{
	protected $table ='usuarios';

    public $fillable = ['first_name','last_name'];
}
