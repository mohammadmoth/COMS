<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class children extends Model
{

    protected $fillable = [
        'firstname', 'lastname', 'mothername', 'father' , 'mobilephone' , 'phone', 'birthplace' , 'birthday' , 'extradata'
    ];

    //
}
