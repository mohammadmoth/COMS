<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ClinicalExam extends Model
{
    protected $fillable = [
        'children_id', 'doctor_id'
    ];


    public function Doctor()
    {
        $this->hasOne('App\Doctor');
    }
    public function children()
    {
        $this->hasOne('App\children');
    }
}
