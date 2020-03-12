<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class hasfromsponsors extends Model
{

    protected $fillable = [
        'id_child', 'id_sponsor', 'startsopnser', 'startend' , 'extradata'
    ];

    //
}
