<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ClinicalExam extends Model
{
    protected $fillable = [
        'children_id', 'doctor_id', 'date', 'case'
    ];
}
