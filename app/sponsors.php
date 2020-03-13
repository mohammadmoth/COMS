<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Sponsors extends Model
{

    protected $fillable = [
        'firstname', 'lastname', 'mobilephone', 'phone' , 'infoSponser'
    ];
    //
}
