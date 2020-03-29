<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Childrens extends Model
{
    

    protected $fillable = [
        'firstname', 'lastname', 'mothername', 'father' , 'mobilephone' , 'phone', 'birthplace' , 'birthday' , 'srugerytypeid'
    ];

   
    //
}
