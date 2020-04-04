<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Sponsors extends Model
{

    protected $fillable = [
        'firstname', 'lastname', 'mobilephone', 'phone' ,"birthday","idnumber", 'typesponsor' , "tags_id"
    ];
    //
}
