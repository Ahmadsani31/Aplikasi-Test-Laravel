<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BMICalculator extends Model
{
    //
    protected $table = 'bmi_calculators';
    protected $fillable = [
        'name',
        'gender',
        'weight',
        'height',
        'bmi',
        'category',
        'ideal_weight'
    ];

    public $timestamps = true;
}
