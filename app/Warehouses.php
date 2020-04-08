<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Warehouses extends Model
{


    protected $fillable = [
        'tags_id', 'countofwares' , 'inputoutput','date','numberwarehouse'
    ];

    //
}
