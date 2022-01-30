<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Crop extends Model
{
    use HasFactory;
    protected $fillable = [
        'farm_id',
        'desc',
        'type_of_crop',
        'quantity',
        'weight',
        'date',
    ];


    public function farm(){
        return $this->belongsTo(Farm::class, 'farm_id');
    }
}
