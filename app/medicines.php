<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class medicines extends Model
{
    protected $fillable = [
        'id_childrens', 'nameTag', 'extradata'
    ];
    //
}
