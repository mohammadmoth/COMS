<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Medicines extends Model
{
    protected $fillable = [
        'id_childrens', 'nameTag', 'extradata'
    ];
    //
}
