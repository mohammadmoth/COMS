<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Family extends Model
{

   protected $table = "families";

    protected $fillable = [
        'husband', 'wife', 'mobile','economic_status','previous_resident_address', 'current_resident_address','count'
    ];
}
