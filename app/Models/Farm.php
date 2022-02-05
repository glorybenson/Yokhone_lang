<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Farm extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'farm_name',
        'farm_desc',
        'amount',
        'acquisition_date',
        'surface',
        'latitude',
        'longitude',
    ];
}
