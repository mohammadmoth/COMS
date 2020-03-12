<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class sponsors extends Model
{

    protected $fillable = [
        'firstname', 'lastname', 'mobilephone', 'phone' , 'infoSponser'
    ];
    //
}
